<?php

namespace App\Http\Controllers;
use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use App\Models\Logs;
use Illuminate\Http\Request;
use DB;
date_default_timezone_set('Asia/Manila');

class AuthController extends Controller
{
    public function waterlevel(Request $request){
        $apiKey = 'Z8798X8HG3V4QBWB';
        // Validation Rules
        $rules = [
            'api_key' => 'required',
            'field1' => 'required',
            'field2' => 'required',
            'field3' => 'required',
        ];
        $request->validate($rules);

        // User Data
        $device = Device::where('id', $request->field3)->first();

        // Return
        if ($device && $request->api_key == $apiKey) {
        
                // Create Data in DB (Device Table)
                $data = new WaterLevel();
                $data->device_id = $request->field3;
                $data->height = $request->field1;
                $data->color = $request->field2;
        
                // Save to DB (Water Level Table)
                $data->save();
        
            $response = [ 
                'message' => 'Successfully saved to database', 
            ];
            return response()->json($response, 200);
        }
        $response = ['message' => 'Could not send data.'];
        return response()->json($response, 400);
    }

    public function registered(Request $request){
        $registered = array();
        // Validation Rules
        $rules = [
            'field3' => 'required',
        ];
        $request->validate($rules);

        // User Data
        $device = Device::where('id', $request->field3)->first();

        // Return
        if ($device) {

            $reg = RegisteredNumbers::where('device_id',$request->field3)->get();
            foreach($reg as $key=>$value){
                $registered[$key] = '+63'.$value->contact_number;
            }
        
            $response = [ 
                'registered_numbers' => $registered, 
            ];
            
            return response()->json($response, 200);
        }
        $response = ['message' => 'Could not send data.'];
        return response()->json($response, 400);
    }
}