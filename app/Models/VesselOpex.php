<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VesselOpex extends Model
{
    protected $table = "vessel_opex";

    public $fillable = ["vessel_id", "expenses"];
    protected $guarded = ["created_at", "updated_at"];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }
}
