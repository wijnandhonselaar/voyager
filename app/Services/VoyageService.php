<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VoyageRepo;
use InvalidArgumentException;

class VoyageService
{
    protected $voyageRepository;
    protected $vesselService;

    public function __construct(VoyageRepo $voyageRepository, VesselService $vesselService)
    {
        $this->voyageRepository = $voyageRepository;
        $this->vesselService = $vesselService;
    }

    public function create(Array $data) {
        $errors = $this->validate($data);
        if(count($errors) == 0) {
            $vessel = $this->vesselService->get($data["vessel_id"]);
            $data["code"] = "{$vessel->name}-{$data["start"]}";
            return $this->voyageRepository->create($data);
        }
        return $errors;
    }

    public function update(int $id, Array $data) {
        $errors = $this->validate($data, $id);
        if(count($errors) == 0) {
            return $this->voyageRepository->update($id, $data);
        }
        return $errors;
    }

    public function withStatus(int $vessel_id, string $status) {
        return $this->voyageRepository->getWithStatus($vessel_id, $status);
    }

    public function updateVoyageProfitByDate(int $vessel_id, string $date, float $expenses) {
        $voyage = $this->voyageRepository->getbyDate($vessel_id, $date);
        $profit = $voyage->revenues - $voyage->expenses - $expenses;
        return $this->voyageRepository->update($voyage->id, ["profit" => $profit]);
    }

    private function validate($data, $id = null) {
        $fields = [
            "vessel_id" => "required",
            "start" => "required",
            "end" => "required",
            "revenues" => "required",
            "expenses" => "required"
        ];

        if(!empty($id)) {
            $fields["status"] = "required";
        }

        $validator = Validator::make($data, $fields);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $errors = [];

        // Validate dates
        try {
            $start = new DateTime($data["start"]);
            $end = new DateTime($data["end"]);
            if($start > $end) {
                $errors[] = "Start date is greater than the End date of the voyage.";
            }
        } catch (\Exception $e) {
            throw new InvalidArgumentException("Invalid date format.");
        }

        // Validate ongoing voyages for vessel
        if(!empty($id) && isset($data["status"]) && $data["status"] == "ongoing") {
            if(count($this->withStatus($id, "ongoing")) > 0) {
                $errors[] = "There already is an ongoing voyage for the submitted voyage.";
            }
        }
        return $errors;
    }
}
