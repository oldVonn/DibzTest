<?php

namespace App\Http\Controllers;

use App\Models\TblGarage;

use Illuminate\Http\Request;

class GarageController extends Controller
{
    //
    public function index() {
        $garage = TblGarage::all();
        return response()->json([$garage], 200);
    }

    public function store(Request $request) {
        
        $garage = new TblGarage();
        $garage->name = $request->name;
        $garage->description = $request->description;
        $garage->address = $request->address;
        $garage->status = $request->status;

        $garage->save();

        if($garage) return response()->json(['Garage saved'], 200);

        return response()->json(['Failed to save Garage'], 400);
    }

    public function update(Request $request) {
        $garage = TblGarage::find($request->id);
        $garage->name = $request->name;
        $garage->description = $request->description;
        $garage->address = $request->address;
        $garage->status = $request->status;
        
        $updated = $garage->save();

        if($updated) return response()->json(['Garage has been updated'], 200);

        return response()->json(['Failed to update Garage'], 400);
    }
    
    public function delete(Request $request) {
        $garage = TblGarage::find($request->id);
        
        $deleted = $garage->delete();

        if($deleted) return response()->json(['Garage deleted'], 200);

        return response()->json(['Failed to deleted Garage'], 400);
    }

    public function show($id) {
        $garage = TblGarage::findOrFail($id);
        return json_encode($garage);
    }

}
