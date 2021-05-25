<?php


namespace App\Repositories;


use App\Models\Vessel;

class VesselRepo
{
    protected $vessel;

    public function __construct(Vessel $vessel)
    {
        $this->vessel = $vessel;
    }
}
