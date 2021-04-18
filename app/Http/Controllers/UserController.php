<?php

namespace App\Http\Controllers;

use App\Models\TblGarage;
use App\Models\TblUser;

use App\Http\Controllers\GarageController;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){

    }
    
    public function registerAdmin(Request $request) {
           
        $garage = new TblGarage();
        $garage->name = $request->garage_name;
        $garage->description = $request->description;
        $garage->address = $request->address;
        $garage->status = $request->status;

        $garage->save();

        $user = new TblUser();
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->access_level = $request->access_level;
        $user->password = $request->password;
        $user->profile_picture = "";
        $user->garage_id = $garage->id;

        if($request->hasFile('img')) {
            $now = now();
            $time = time();
            if($request->file()) {
                $allowedfileExtension=['jpg','png'];
                $file = $request->file('img'); 
                $extension = $file->extension();
                $check = in_array($extension,$allowedfileExtension);
                if($check) {
                    $user->profile_picture = $time."-".$file->getClientOriginalName();
                    $filePath = $file->storeAs('profile/'.$garage->id, $user->profile_picture, 'local');
                }
            }
        }
        $user->save();
        
        auth()->login($user);

        if($user) return response()->json(['User saved'], 200);

        return response()->json(['Failed to save user'], 400);
    }

}
