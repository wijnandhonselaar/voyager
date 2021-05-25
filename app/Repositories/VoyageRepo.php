<?php


namespace App\Repositories;


use App\Models\Voyage;

class VoyageRepo
{
    protected $voyage;

    public function __construct(Voyage $voyage)
    {
        $this->voyage = $voyage;
    }

    public function getWithStatus($vessel_id, $status) {
        return $this->voyage->where([['vessel_id', '=', $vessel_id]], ['status', '=', $status])->get();
    }

    public function create($data) {
        $voyage = new $this->voyage();
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->vessel_id = $data["vessel_id"];
        return $voyage->fresh();
    }

    public function getById($id) {
        return $this->voyage->where('id', '=', $id)->get();
    }

    public function update($id, $data) {
        $voyage = $this->getById($id);
        $voyage->update($data);
        return $voyage->fresh();
    }
}
