<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    public $fillable = ['name', 'imo', 'date'];
    protected $guarded = ['created_at', 'updated_at'];

    public function voyages() {
        return $this->hasMany(Voyage::class);
    }

    public function vesselOpex() {
        return $this->hasMany(VesselOpex::class);
    }
}
