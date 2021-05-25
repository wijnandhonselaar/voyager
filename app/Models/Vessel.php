<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    public $fillable = ['name', 'imo'];
    public $guarded = ['created_at', 'updated_at'];

    public function voyages() {
        return $this->hasMany(Voyage::class);
    }

    public function vessel_opex() {
        return $this->hasMany(Vessel_opex::class);
    }
}
