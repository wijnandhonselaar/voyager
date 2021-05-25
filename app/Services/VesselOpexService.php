<?php

namespace App\Services;

use App\Repositories\VesselOpexRepo;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VesselOpexService
{
    protected $vesselOpexRepository;

    public function __construct(VesselOpexRepo $vesselOpexRepository)
    {
        $this->vesselOpexRepository = $vesselOpexRepository;
    }

    public function create($data) {
        $errors = $this->validate($data);
        if(count($errors) == 0) {
            return $this->vesselOpexRepository->create($data);
        }
        return $errors;
    }

    private function validate($data) {
        $fields = [
            "vessel_id" => "required",
            "date" => "required",
            "expenses" => "required"
        ];

        $validator = Validator::make($data, $fields);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $errors = [];

        $existingVesselOpex = $this->vesselOpexRepository->getByVesselIdAndDate($data["vessel_id"], $data["date"]);
        if(!empty($existingVesselOpex)) {
            $errors[] = "There already is an existing Vessel Opex for the submitted date.";
        }

        return $errors;
    }
}
