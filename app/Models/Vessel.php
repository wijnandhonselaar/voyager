<?php


class Vessel
{
    public $fillable = ['name', 'imo'];
    public $guarded = ['created_at', 'updated_at'];
}
