<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'color',
        'brand',
        'type',
        'owner_id',
    ];

    public function owner()
    {
        return $this->hasOne('App\Models\Owner');
    }

    public function getTypeAttribute()
    {
        return ($this->type === "private") ? "Privado" : "Público";
    }
}
