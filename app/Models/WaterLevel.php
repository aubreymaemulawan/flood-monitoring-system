<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLevel extends Model
{
    protected $table = 'water_level';
    protected $primaryKey = 'id';

    // A Registered Number belongs to a Device
    public function device(){
        return $this->belongsTo(Device::class);
    }
}