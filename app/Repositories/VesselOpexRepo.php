<?php


namespace App\Repositories;


use App\Models\VesselOpex;

class VesselOpexRepo
{
    protected $vesselOpex;

    public function __construct(VesselOpex $vesselOpex)
    {
        $this->vesselOpex = $vesselOpex;
    }
}
