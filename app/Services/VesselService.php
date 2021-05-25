<?php

namespace App\Services;

use App\Repositories\VesselRepo;

class VesselService
{
    protected $vesselRepository;

    public function __construct(VesselRepo $vesselRepository)
    {
        $this->vesselRepository = $vesselRepository;
    }

    public function get($id) {
        return $this->vesselRepository->getbyId($id);
    }
}
