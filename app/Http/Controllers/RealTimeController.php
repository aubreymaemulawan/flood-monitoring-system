<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use App\Models\Logs;
use PDF;
use DB;
use Auth;
date_default_timezone_set('Asia/Manila');

class RealTimeController extends Controller
{
    public function today_table(){
        $water_level = WaterLevel::with('device')->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at','desc')->get();
        return view('today_table', compact('water_level'));
    }

    public function main_table(){
        $water_level = WaterLevel::with('device')->orderBy('created_at','desc')->get();
        return view('main_table', compact('water_level'));
    }

}