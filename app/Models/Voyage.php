<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    public $fillable = ["vessel_id", "code", "start", "end", "status", "revenues", "expenses", "profit"];
    public $guarded = ["created_at", "updated_at"];

    public $statuses = ["pending", "ongoing", "submitted"];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }
}
