<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use App\Models\Logs;
use DB;
date_default_timezone_set('Asia/Manila');

class WaterLevelController extends Controller {
    
    public function generateChart(Request $request){
        $selectdate = date('Y-m-d', strtotime($request->selectedDate));
        $day = $request->selectedDate;
        $data = array();
        $height = array();
        $color = array();
        $date = array();
        $random = array();
        $water = array();
        $timestmp = array();
        $device_name = array();
        $device_id = array();
        $water_level = WaterLevel::with('device')->whereDate('created_at', '=', $selectdate)->orderBy('created_at','asc')->get();

        // Chart 1
        $rd = Device::where('status',1)->get();
        foreach($rd as $value){
            $device_name[] = $value->device_name;
            $device_id[] = $value->id;
        }

        // Chart 2
        // foreach($device_id as $didi){
        //     $nm = Device::where('id',$didi)->value('location');
        //     $wr = WaterLevel::where('device_id', $didi)->whereDate('created_at', '=', $date)->orderBy('created_at','asc')->pluck('height')->toArray();
        //     $water[] = array('name' => $nm,'data' => $wr,);
        //     $tmp_today = WaterLevel::where('device_id', $didi)->whereDate('created_at', $date)->orderBy('created_at','asc')->pluck('created_at')->toArray();
        //     $timestmp[] = $tmp_today;
        //     $random[] = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        // }

        // $flattenedRow = array_reduce($timestmp, function ($a, $b) {
        //     return array_merge($a, $b);
        // }, []);

        foreach($device_id as $didi){
            $height = [];
            $color = [];
            $date = [];
            $name = Device::where('id',$didi)->value('device_name');
            $location = Device::where('id',$didi)->value('location');
            $wat = WaterLevel::where('device_id',$didi)->orderBy('created_at','desc')->whereDate('created_at', $selectdate)->get();
            foreach($wat as $w){
                $height[] = $w->height;
                $color[] = $w->color;
                $date[] = $w->created_at;
            }
            $random = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $data[] = [
                'data' => [
                    'name' => $name,
                    'location' => $location,
                    'height' => $height,
                    'dates' => $date,
                    'color' => $color,
                    'random' => $random,
                ]
            ];            
        }
    
        if(!$water_level){
            return response()->json([0,0]);
        }else{
            return response()->json([$data,$water_level]);
        }
        
    }

    public function delete(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->device == 0 && $request->color == 'all'){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->get();
        }else if($request->device == 0 && $request->color != 'all'){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->where('color', $request->color)->get();
        }else if($request->color == 'all' && $request->device != 0){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->where('device_id', $request->device)->get();
        }else{
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])
            ->where([['color', $request->color], ['device_id', $request->device]])
            ->get();
        }
        // if($data){
        //     foreach($data as $dt){
        //         $data = WaterLevel::find($dt->id);
        //         $data->delete();
        //     }
            


        //     return json_encode( 
        //         ['success'=>true]
        //     );

        // }

        if (count($data) != 0) {
            foreach($data as $dt){
                $data = WaterLevel::find($dt->id);
                $data->delete();
            }

            // Insert Log
            $log = new Logs();
            $log->action_type = '2';
            $log->user_id = $request->user_id;
            $log->user_type = $request->user_type;
            $log->status_code = '200'; 
            $log->save();
            return response()->json(1);
        }
        

        
        
    }
}