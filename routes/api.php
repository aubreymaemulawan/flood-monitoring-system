<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredNumbersController;
use App\Http\Controllers\WaterLevelController;
use App\Http\Controllers\AuthController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Device
Route::match(['get','post',], 'device/list', [DeviceController::class,'list']);
Route::match(['get','post',], 'device/items', [DeviceController::class,'items']);
Route::match(['get','post',], 'device/create', [DeviceController::class,'create']);
Route::match(['get','post',], 'device/update', [DeviceController::class,'update']);
Route::match(['get','post',], 'device/delete', [DeviceController::class,'delete']);

// Registered Numbers
Route::match(['get','post',], 'registered/create', [RegisteredNumbersController::class,'create']);
Route::match(['get','post',], 'registered/valid', [RegisteredNumbersController::class,'valid']);
Route::match(['get','post',], 'registered/delete', [RegisteredNumbersController::class,'delete']);

// Water Level
Route::match(['get','post',], 'water_level/generateChart', [WaterLevelController::class,'generateChart']);
Route::match(['get','post',], 'water_level/delete', [WaterLevelController::class,'delete']);

// 
Route::get('export-data', [DeviceController::class, 'exportData'])->name('exportData');
Route::get('generate-waterlevel', [DeviceController::class, 'generateWaterLevel'])->name('generateWaterLevel');
Route::get('generate-registerednumbers', [DeviceController::class, 'generateRegisteredNumbers'])->name('generateRegisteredNumbers');

// Profile
Route::match(['get','post',], 'profile/change_password', [ProfileController::class,'change_password']);
Route::match(['get','post',], 'profile/edit_username', [ProfileController::class,'edit_username']);

//Save Data to DB
Route::match(['get','post',], '/auth/waterlevel', [AuthController::class,'waterlevel']);
Route::match(['get','post',], '/auth/registered', [AuthController::class,'registered']);