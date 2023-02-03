<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use ProtoneMedia\LaravelVerifyNewEmail\MustVerifyNewEmail;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use DB;
date_default_timezone_set('Asia/Manila');


class ProfileController extends Controller
{
    public function change_password(Request $request){
        // Validation Rules
        $request->validate([
            'current_password' => 'required',
        ]);

        // Check current password if correct
        $pass = User::where('id', $request->id)->value('password');
        if(!password_verify($request->current_password, $pass)){
            return response()->json(1);
        }

        // Check if its an old password
        if(password_verify($request->new_password, $pass)){
            return response()->json(2);
        }

        // Validation Rules
        $request->validate([
            'new_password' => 'required|min:8',
            'retype_password' => 'required|required_with:new_password|same:new_password',
        ],[
            'retype_password.same' => 'The retype password does not match.'
        ]);

        if($request->new_password == $request->retype_password){
            // Update Password in DB (User Table)
            DB::table('users')->where('id', $request->id)->update([
                'password' => bcrypt($request->new_password)
            ]);

            // Insert Log
            $data = new Logs();
            $data->action_type = '4';
            $data->user_id = $request->id;
            $data->user_type = $request->user_type;
            $data->status_code = '200'; 
            $data->save();

            // Return
            return json_encode(
                ['success'=>true]
            );
        }
    }
}
