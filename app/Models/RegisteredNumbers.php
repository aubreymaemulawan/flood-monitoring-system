<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredNumbers extends Model
{
    protected $table = 'registered_numbers';
    protected $primaryKey = 'id';

    // A Registered Number belongs to a Device
    public function device(){
        return $this->belongsTo(Device::class);
    }
}