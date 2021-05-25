<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VoyageRepo;
use InvalidArgumentException;

class VoyageService
{
    protected $voyageRepository;

    public function __construct(VoyageRepo $voyageRepository)
    {
        $this->voyageRepository = $voyageRepository;
    }

    public function create(Array $data) {
        $errors = $this->validate($data);
        if(count($errors) == 0) {
            $vesselName = "";
            $data["code"] = "{$vesselName}-{$data["start"]}";
            return $this->voyageRepository->create($data);
        }
        return $errors;
    }

    public function withStatus($vessel_id, $status) {
        return $this->voyageRepository->getWithStatus($vessel_id, $status);
    }


    private function validate($data, $id = null) {
        $validator = Validator::make($data, [
            'vessel_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'revenues' => 'required',
            'expenses' => 'required'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $errors = [];

        // Validate dates
        try {
            $start = new DateTime($data["start"]);
            $end = new DateTime($data["start"]);
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
