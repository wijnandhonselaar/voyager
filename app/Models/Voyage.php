<?php


class Voyage
{
    public $fillable = ["vessel_id", "code", "start", "end", "status", "revenues", "expenses", "profit"];
    public $guarded = ["created_at", "updated_at"];

    public $statuses = ["pending", "ongoing", "submitted"];
}
