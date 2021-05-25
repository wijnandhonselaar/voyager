<?php


namespace App\Repositories;


use App\Models\Voyage;

/**
 * Class VoyageRepo
 * @package App\Repositories
 */
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
        // voyage->status default value is "pending"
        $voyage = new $this->voyage();
        $voyage->vessel_id = $data["vessel_id"];
        $voyage->code = $data["code"];
        $voyage->start = $data["start"];
        $voyage->end = $data["end"];
        $voyage->revenues = $data["revenues"];
        $voyage->expenses = $data["expenses"];
        $voyage->save();

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
