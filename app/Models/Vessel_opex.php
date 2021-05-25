<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel_opex extends Model
{
    public $fillable = ["vessel_id", "expenses"];
    public $guarded = ["created_at", "updated_at"];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }
}
