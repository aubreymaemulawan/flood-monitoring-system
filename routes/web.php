<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RealTimeController;

use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

// Website Views
Route::get('/', function () {
    $device = Device::all();
    $water_level = WaterLevel::with('device')->orderBy('created_at','asc')->get();
    return view('index', compact('device','water_level'));
});

Route::get('/pages-contact-us', function () {
    $device = Device::all();
    $water_level = WaterLevel::orderBy('created_at','desc')->get();
    return view('contact_us', compact('device','water_level'));
});

Route::get('/pages-about-us', function () {
    $device = Device::all();
    $water_level = WaterLevel::orderBy('created_at','desc')->get();
    return view('about_us', compact('device','water_level'));
});

Route::get('/pages-today', function () {
    $data = array();
    $height = array();
    $color = array();
    $date = array();
    $device_name = array();
    $device_id = array();
    $water_level = WaterLevel::with('device')->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at','asc')->get();
    $registered = RegisteredNumbers::all();
    $device = Device::all();

    $rd = Device::where('status',1)->get();
    foreach($rd as $value){
        $device_id[] = $value->id;
    }
    // Chart 2
    foreach($device_id as $didi){
        $height = [];
        $color = [];
        $date = [];
        $name = Device::where('id',$didi)->value('device_name');
        $location = Device::where('id',$didi)->value('location');
        $wat = WaterLevel::where('device_id',$didi)->orderBy('created_at','desc')->whereDate('created_at', '=', date('Y-m-d'))->get();
        foreach($wat as $w){
            $height[] = $w->height;
            $color[] = $w->color;
            $date[] = $w->created_at;
        }
        // $random = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        $data[] = [
            'data' => [
                'name' => $name,
                'location' => $location,
                'height' => $height,
                'dates' => $date,
                'color' => $color,
            ]
        ];
        
        // $nm = Device::where('id',$didi)->value('location');
        // $wr = WaterLevel::where('device_id', $didi)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at','asc')->pluck('height')->toArray();
        // $water_today[] = array('name' => $nm,'data' => $wr,);
        // $tmp_today = WaterLevel::where('device_id', $didi)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at','asc')->pluck('created_at')->toArray();
        // $timestamp_today[] = $tmp_today;
        
    }
    

    // $flattenedRow_today = array_reduce($timestamp_today, function ($a, $b) { return array_merge($a, $b);}, []);

    return view('today', compact(
        'water_level',
        'device',
        'registered',
        'data'
        )
    );
});

Route::get('/pages-daily', function () {
    $device = Device::all();
    $water_level = WaterLevel::orderBy('created_at','desc')->get();
    return view('daily', compact('device','water_level'));
});

Auth::routes();

// Admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/manage-devices', [PageController::class, 'manage_devices']);
Route::get('/water-level', [PageController::class, 'water_level']);
Route::get('/registered-numbers', [PageController::class, 'registered_numbers']);
Route::get('/export-data', [PageController::class, 'export_data']);
Route::get('/report-waterLevel', [PageController::class, 'report_waterLevel']);
Route::get('/report-registeredNumbers', [PageController::class, 'report_registeredNumbers']);
Route::get('/profile', [PageController::class, 'profile']);
Route::get('/today-table', [RealTimeController::class, 'today_table']);
Route::get('/main-table', [RealTimeController::class, 'main_table']);


