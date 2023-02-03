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


class PageController extends Controller
{
    // Need Auth to go to routes
    public function __construct() {
        $this->middleware('auth');
    }
    
    // Admin Views
    public function manage_devices(){
        $device = Device::orderBy('created_at','asc')->get();
        $registered = RegisteredNumbers::all();
        return view('admin.manage_devices', compact('device','registered'));
    }

    public function water_level(){
        $water_level = WaterLevel::with('device')->orderBy('created_at','asc')->get();
        $device = Device::all();
        return view('admin.water_level', compact('water_level','device'));
    }

    public function registered_numbers(){
        $registered_numbers = RegisteredNumbers::with('device')->orderBy('created_at','asc')->get();
        return view('admin.registered_numbers', compact('registered_numbers'));
    } 

    public function export_data(){
        $water_level = WaterLevel::all();
        $registered_numbers = RegisteredNumbers::all();
        $device = Device::all();
        return view('admin.export_data', compact('water_level','registered_numbers','device'));
    }

    public function report_waterLevel(){
        $water_level = WaterLevel::all();
        $registered_numbers = RegisteredNumbers::all();
        $device = Device::all();
        return view('admin.report_waterLevel', compact('water_level','registered_numbers','device'));
    }
    
    public function report_registeredNumbers(){
        $water_level = WaterLevel::all();
        $registered_numbers = RegisteredNumbers::all();
        $device = Device::all();
        return view('admin.report_registeredNumbers', compact('water_level','registered_numbers','device'));
    }

    public function profile(){
        $logs = Logs::all();
        $last_updated = Logs::where([['action_type',4],['user_id', Auth::user()->id]])->latest('created_at')->value('created_at');
        return view('admin.profile', compact('logs', 'last_updated'));
    }

}
 