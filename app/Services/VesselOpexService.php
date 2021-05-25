<?php

namespace App\Services;

use App\Repositories\VesselOpexRepo;

class VesselOpexService
{
    protected $vesselOpexRepository;

    public function __construct(VesselOpexRepo $vesselOpexRepository)
    {
        $this->vesselOpexRepository = $vesselOpexRepository;
    }

    public function create($data) {

    }
}
