<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\WaterLevel;
use App\Models\RegisteredNumbers;
use DB;
date_default_timezone_set('Asia/Manila');

class RegisteredNumbersController extends Controller
{
    public function create(Request $request){
        $cnt = 0;
        // Validation Rules
        $request->validate([
            'contact_number' => 'required|digits:11',
            'device_id' => 'required',
        ]);
        $rn = RegisteredNumbers::where([['contact_number', $request->contact_number],['device_id', $request->device_id]])->get();
        $cnt = count($rn);

        if($cnt != 0){
            return response()->json(0);
        }

        // Create Data in DB (Device Table)
        $data = new RegisteredNumbers();
        $data->contact_number = $request->contact_number;
        $data->device_id = $request->device_id;

        // Save to DB (Device Table)
        $data->save();

        // Return
        return json_encode( 
            ['success'=>true]
        );
    } 
    
    public function valid(Request $request){
        $cnt = 0;
       // Validation Rules
        $request->validate([
            'contact' => 'required|digits:11',
            'device' => 'required',
        ]);

        $rn = RegisteredNumbers::where([['contact_number', $request->contact],['device_id', $request->device]])->first();
        if(empty($rn)){
            return response()->json(0);
        }else{
            return json_encode($rn);
        }
    }

    public function delete(Request $request){
        $data = RegisteredNumbers::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    
}
