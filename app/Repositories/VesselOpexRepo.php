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

    public function getByVesselIdAndDate($vessel_id, $date) {
        return $this->vesselOpex->where([['vessel_id', '=', $vessel_id], ['date', '=', $date]])->get();
    }
}
