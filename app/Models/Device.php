<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'device';
    protected $primaryKey = 'id';

    // INVERSE: A Device has many Registered Numbers
    public function registered_numbers(){
        return $this->hasMany(RegisteredNumbers::class);
    }

    // INVERSE: A Device has many Water Level
    public function water_level(){
        return $this->hasMany(WaterLevel::class);
    }

}