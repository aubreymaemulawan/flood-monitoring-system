<?php
namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Logs;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use DB;
use Illuminate\Support\Facades\Auth;
date_default_timezone_set('Asia/Manila');


class DeviceController extends Controller
{
    public function list(Request $request){
        return json_encode(Device::all()->get());
    }

    public function items(Request $request){
        return json_encode(Device::find($request->id));
    }

    public function create(Request $request){
        
        // Validation Rules
        $request->validate([
            'device_name' => 'required|unique:device',
            'location' => 'required|unique:device',
        ]);

        // Create Data in DB (Device Table)
        $data = new Device();
        $data->device_name = $request->device_name;
        $data->location = $request->location;
        $data->status = 1;

        // Save to DB (Device Table)
        $data->save();

        // Insert Log
        $log = new Logs();
        $log->action_type = '1.1';
        $log->user_id = $request->user_id;
        $log->user_type = $request->user_type;
        $log->status_code = '200'; 
        $log->save();

        // Return
        return json_encode( 
            ['success'=>true]
        );
    } 

    public function update(Request $request){
        // Validation Rules
        $request->validate([
            'device_name' => ['required', Rule::unique('device','device_name')->ignore($request->id)],
            'location' => ['required', Rule::unique('device','location')->ignore($request->id)],
            'status' => 'required',
        ]);

        // Update Data in DB (Bus Table)
        $data = Device::find($request->id);
        $data->device_name = $request->device_name;
        $data->location = $request->location;
        $data->status = $request->status;

        // Save to DB (Bus Table)
        $data->save();

        // Insert Log
        $log = new Logs();
        $log->action_type = '1.2';
        $log->user_id = $request->user_id;
        $log->user_type = $request->user_type;
        $log->status_code = '200'; 
        $log->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
    }
    
    public function delete(Request $request){
        $count = 0;
        $count1 = 0;
        $data = Device::find($request->id);
        $find_waterLevel = WaterLevel::where('device_id',$request->id)->get();
        $count = $find_waterLevel->count();

        $find_registeredNumbers = RegisteredNumbers::where('device_id',$request->id)->get();
        $count1 = $find_registeredNumbers->count();

        if($count != 0){ // Restrict Deletion (Water Level)
            return response()->json(1);
        }else if($count1 != 0 ){ // Restrict Deletion (Registered Numbers)
            return response()->json(2);
        }else{
            $data->delete();

            // Insert Log
            $log = new Logs();
            $log->action_type = '1.3';
            $log->user_id = $request->user_id;
            $log->user_type = $request->user_type;
            $log->status_code = '200'; 
            $log->save();

            return json_encode( 
                ['success'=>true]
            );
        }
    }

    public function exportData(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        $col = array();
        if($request->device == 0 && $request->color == 'all'){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->orderBy('created_at','asc')->get();
        }else if($request->device == 0 && $request->color != 'all'){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->where('color', $request->color)->orderBy('created_at','asc')->get();
        }else if($request->color == 'all' && $request->device != 0){
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->where('device_id', $request->device)->orderBy('created_at','asc')->get();
        }else{
            $data = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])
            ->where([['color', $request->color], ['device_id', $request->device]])
            ->orderBy('created_at','asc')
            ->get();
        }
        
        if (count($data) > 0) {
            return response()->json($data);
        }else{
            return response()->json(0);
        }
    } 

    public function generateWaterLevel(Request $request){
        $height = array();
        $color = array();
        $date = array();
        $dates = array();
        $from = date($request->from);
        $to = date($request->to);
        $wl = WaterLevel::with('device')->whereBetween('created_at', [$from, $to])->where('device_id', $request->device)->orderBy('created_at','asc')->get();
        $dev_name = Device::where('id',$request->device)->value('device_name');
        foreach($wl as $w){
            $height[] = $w->height;
            $color[] = $w->color;
            $date[] = $w->created_at;
        }
        $data = [
            'data' => [
                'device_name' => $dev_name,
                'height' => $height,
                'dates' => $date,
                'color' => $color,
            ]
        ];
        if(count($wl) == 0){
            return response()->json([0,0]);
        }else{
            return response()->json([$data,$wl]);
        }
    }

    public function generateRegisteredNumbers(Request $request){
        $contact_number = array();
        $dev_location = array();
        $date = array();
        $dev_name = array();
        $from = date($request->from);
        $to = date($request->to);
 
        if($request->device == 0){
            $dev_name = Device::pluck('device_name')->toArray();
            
            $wl = RegisteredNumbers::with('device')->whereBetween('created_at', [$from, $to])->orderBy('created_at','asc')->get();
        }else{
            $wl = RegisteredNumbers::with('device')->whereBetween('created_at', [$from, $to])->where('device_id', $request->device)->orderBy('created_at','asc')->get();
        }
        if(count($wl) == 0){
            return response()->json(0);
        }else{
            return response()->json($wl);
        }
    }


    
}
