<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblGarage;
use App\Models\TblGaragePhoto;

class GaragePhotoController extends Controller
{
    //
    public function index() {
        $garage = TblGaragePhoto::all();
        return json_encode($garage);
    }

    public function store(Request $request) {
        if(!$request->hasFile('imgs')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $now = now();
        $time = time();
        if($request->file()) {
            $allowedfileExtension=['jpg','png'];
            $files = $request->file('imgs'); 
            foreach ($files as $file) {
                $extension = $file->extension();
                $check = in_array($extension,$allowedfileExtension);
                if($check) {
                    $name = $time."-".$file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/'.$request->garage_id, $name, 'local');
                    $data = getimagesize($file);
                    $width = $data[0];
                    $height = $data[1];

                    // saving to database_
                    $garage = new TblGaragePhoto();
                    $garage->name = $name;
                    $garage->width = $width;
                    $garage->height = $height;
                    $garage->extension = $extension;
                    $garage->garage_id = $request->garage_id;

                    $garage->save();
                } else {
                    return response()->json(['invalid_file_format'], 422);
                }
            }
            
            // delete previous photos
            TblGaragePhoto::where("garage_id",1)->where('created_at', '<', $now)->delete();
            return response()->json(['file_uploaded'], 200);
        } else {
            return response()->json(['invalid_file_format'], 422);
        }
    }

    public function update(Request $request) {
        if(!$request->hasFile('img')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $now = now();
        $time = time();
        if($request->file()) {
            $allowedfileExtension=['jpg','png'];
            $file = $request->file('img'); 
            $extension = $file->extension();
            $check = in_array($extension,$allowedfileExtension);
            if($check) {
                $name = $time."-".$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/'.$request->garage_id, $name, 'local');
                $data = getimagesize($file);
                $width = $data[0];
                $height = $data[1];

                // saving to database_
                $garage = new TblGaragePhoto();
                $garage->name = $name;
                $garage->width = $width;
                $garage->height = $height;
                $garage->extension = $extension;
                $garage->garage_id = $request->garage_id;

                $garage->save();

                $garage->find($request->id)->delete();
            } else {
                return response()->json(['invalid_file_format'], 422);
            }
            
            // delete previous photos
            return response()->json(['file_uploaded'], 200);
        } else {
            return response()->json(['invalid_file_format'], 422);
        }
    }
    
    public function delete(Request $request) {
        $garage = TblGaragePhoto::find($request->id);
        
        $deleted = $garage->delete();

        if($deleted) return response()->json(['Garage Photo Deleted'], 200);

        return response()->json(['Failes to update Garage Photo'], 422);
    }

    public function show($id) {
        $garage = TblGaragePhoto::findOrFail($id);
        return json_encode($garage);
    }
}
