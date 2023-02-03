<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Device extends Migration
{
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_name')->unique();
            $table->string('location')->unique();
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device');
    }
};
