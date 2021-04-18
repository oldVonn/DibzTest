<?php

namespace App\Http\Controllers;

use App\Models\TblGarage;
use App\Models\TblGarageRate;

use Illuminate\Http\Request;

class GarageRateController extends Controller
{
    public function index() {
        $garage = TblGarageRate::all();
        return response()->json([$garage], 200);
    }

    public function store(Request $request) {
        
        $garage = new TblGarageRate();
        $garage->day = $request->day;
        $garage->opening_time = $request->opening_time;
        $garage->closing_time = $request->closing_time;
        $garage->type = $request->type;
        $garage->rate = $request->rate;
        $garage->status = $request->status;
        $garage->succeeding_rate = $request->succeeding_rate;
        $garage->garage_id = $request->garage_id;

        $garageExist = TblGarageRate::where([["garage_id",$garage->garage_id],["day",$garage->day]])->count();
        if($garageExist  > 0) return response()->json(['Garage rate exist, please proceed to update garage rate'], 200);

        $garage->save();
        
        if($garage) return response()->json(['Garage rate saved'], 200);

        return response()->json(['Failed to save Garage rate'], 400);
    }

    public function update(Request $request) {
        $garage = TblGarageRate::find($request->id);
        $garage->day = $request->day;
        $garage->opening_time = $request->opening_time;
        $garage->closing_time = $request->closing_time;
        $garage->type = $request->type;
        $garage->rate = $request->rate;
        $garage->status = $request->status;
        $garage->succeeding_rate = $request->succeeding_rate;
        $garage->garage_id = $request->garage_id;
        
        $updated = $garage->save();

        if($updated) return response()->json(['Garage rate has been updated'], 200);

        return response()->json(['Failed to update Garage rate'], 400);
    }
    
    public function delete(Request $request) {
        $garage = TblGarageRate::find($request->id);
        
        $deleted = $garage->delete();

        if($deleted) return response()->json(['Garage rate deleted'], 200);

        return response()->json(['Failed to deleted Garage rate'], 400);
    }

    public function show($id) {
        $garage = TblGarageRate::findOrFail($id);
        return response()->json([$garage], 200);
    }
}
