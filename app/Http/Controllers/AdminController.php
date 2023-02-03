<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use App\Models\Logs;

date_default_timezone_set('Asia/Manila');

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $data_today = array();
        $data_month = array();
        $data_year = array();
        $wat_today = array();
        $wat_month = array();
        $wat_year = array();
        $height_today = array();
        $color_today = array();
        $date_today = array();
        $height_month = array();
        $color_month = array();
        $date_month = array();
        $height_year = array();
        $color_year = array();
        $date_year = array();
        $device_name = array();
        $device_id = array();
        $length_today = array();
        $length_month = array();
        $length_year = array();
        $logs = Logs::orderBy('created_at','desc')->get();
        $registered = RegisteredNumbers::orderBy('created_at','asc')->get();
        $device = Device::all();
         
        // Chart 1
        $rd = Device::where('status',1)->get();
        foreach($rd as $value){
            $device_name[] = $value->device_name;
            $device_id[] = $value->id;
        }
        foreach($device_id as $did){
            $rr = RegisteredNumbers::where('device_id', $did)->whereDate('created_at', '=', date('Y-m-d'))->get();
            $length_today[] = count($rr);
            $rrr = RegisteredNumbers::where('device_id', $did)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
            $length_month[] = count($rrr);
            $rrrr = RegisteredNumbers::where('device_id', $did)->whereYear('created_at', '=', date('Y'))->get();
            $length_year[] = count($rrrr);
        }

        // Chart 2
        foreach($device_id as $didi){
            // $nm = Device::where('id',$didi)->value('device_name');
            // $wr = WaterLevel::where('device_id', $didi)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at','asc')->get();

            // $height_today = $wr->pluck('height')->toArray();
            // $tmp_today = $wr->pluck('created_at')->toArray();
            // $water_today[] = array('name' => $nm,'data' => $height_today);
            // $timestamp_today[] = $tmp_today;
            
            // $wrr = WaterLevel::where('device_id', $didi)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->orderBy('created_at','asc')->pluck('height')->toArray();
            // $water_month[] = array('name' => $nm,'data' => $wrr,);
            // $tmp_month = WaterLevel::where('device_id', $didi)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->orderBy('created_at','asc')->pluck('created_at')->toArray();
            // $timestamp_month[] = $tmp_month;

            // $wrrr = WaterLevel::where('device_id', $didi)->whereYear('created_at', '=', date('Y'))->orderBy('created_at','asc')->pluck('height')->toArray();
            // $water_year[] = array('name' => $nm,'data' => $wrrr,);
            // $tmp_year = WaterLevel::where('device_id', $didi)->whereYear('created_at', '=', date('Y'))->orderBy('created_at','asc')->pluck('created_at')->toArray();
            // $timestamp_year[] = $tmp_year;

            // $random[] = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);

            $height_today = [];
            $color_today = [];
            $date_today = [];
            $height_month = [];
            $color_month = [];
            $date_month = [];
            $height_year = [];
            $color_year = [];
            $date_year = [];
            $name = Device::where('id',$didi)->value('device_name');
            $location = Device::where('id',$didi)->value('location');
            $wat_today = WaterLevel::where('device_id',$didi)->orderBy('created_at','desc')->whereDate('created_at', '=', date('Y-m-d'))->get();
            $wat_month = WaterLevel::where('device_id',$didi)->orderBy('created_at','desc')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
            $wat_year = WaterLevel::where('device_id',$didi)->orderBy('created_at','desc')->whereYear('created_at', '=', date('Y'))->get();
            foreach($wat_today as $wt){
                $height_today[] = $wt->height;
                $color_today[] = $wt->color;
                $date_today[] = $wt->created_at;
            }
            foreach($wat_month as $wm){
                $height_month[] = $wm->height;
                $color_month[] = $wm->color;
                $date_month[] = $wm->created_at;
            }
            foreach($wat_year as $wy){
                $height_year[] = $wy->height;
                $color_year[] = $wy->color;
                $date_year[] = $wy->created_at;
            }
            $data_today[] = [
                'data' => [
                    'name' => $name,
                    'location' => $location,
                    'height' => $height_today,
                    'dates' => $date_today,
                    'color' => $color_today,
                ]
            ];
            $data_month[] = [
                'data' => [
                    'name' => $name,
                    'location' => $location,
                    'height' => $height_month,
                    'dates' => $date_month,
                    'color' => $color_month,
                ]
            ];
            $data_year[] = [
                'data' => [
                    'name' => $name,
                    'location' => $location,
                    'height' => $height_year,
                    'dates' => $date_year,
                    'color' => $color_year,
                ]
            ];
        }

        // if(count($data_today) == 0){
        //     $data_today == 0;
        // }

        // $flattenedRow_today = array_reduce($timestamp_today, function ($a, $b) {
        //     return array_merge($a, $b);
        // }, []);

        // $flattenedRow_month = array_reduce($timestamp_month, function ($a, $b) {
        //     return array_merge($a, $b);
        // }, []);

        // $flattenedRow_year = array_reduce($timestamp_year, function ($a, $b) {
        //     return array_merge($a, $b);
        // }, []);

        return view('admin.dashboard', compact(
            'logs',
            'device',
            'registered',
            'device_name', 
            'length_today',
            'length_month',
            'length_year',
            'data_today',
            'data_month',
            'data_year',
            'wat_today',
            'wat_month',
            'wat_year',
        ));
    }
    
}
