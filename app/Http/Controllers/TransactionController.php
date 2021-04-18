<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\TblTransaction;
use App\Models\TblGarage;
use App\Models\TblGarageRate;

class TransactionController extends Controller
{
    //
    public function index() {
        $trans = TblTransaction::all();
        return response()->json([$trans], 200);
    }

    public function car_in(Request $request) {
        
        $today = Str::lower(now()->format('l'));
        $time = now()->format('H:i:s');
        $now = now();

        $trans = new TblTransaction();

        $trans->garage_id = $request->garage_id;
        $trans->opening_time = now();
        $trans->closing_time = null;
        $trans->total = 0;
        $trans->car_in_by_user_id = $request->car_in_by_user_id;

        $garageExist = TblGarage::join("tbl_garage_rates", "tbl_garages.id", "=", "tbl_garage_rates.garage_id")
            ->where([
                    ["tbl_garages.status","available"],
                    ["tbl_garages.id",$trans->garage_id],
                    ["tbl_garage_rates.status","open"],
                    ["tbl_garage_rates.day",$today],
                    ["tbl_garage_rates.opening_time", "<",$time],
                    ["tbl_garage_rates.closing_time", ">",$time]
                ])
            ->count("tbl_garage_rates.id");

        if($garageExist  == 0) return response()->json(['Garage unavailable'], 200);

        $trans->save();

        $garage = TblGarage::find($trans->garage_id);
        $garage->status = "taken";
        $garage->save();
        
        if($trans) return response()->json(['Success!'], 200);

        return response()->json(['Failed to save Garage rate'], 400);
    }

    public function car_out(Request $request) {

        $trans = TblTransaction::find($request->id);

        if($trans == null) return response()->json(['Unable to process transaction'], 400);
        if($trans->closing_time && $trans->car_out_by_user_id) return response()->json(['Car is already out'], 400);

        $trans->closing_time = now();
        $trans->car_out_by_user_id = $request->car_out_by_user_id;

        $car_day = Str::lower(date('l',strtotime($trans->opening_time)));
        $garageRate = TblGarageRate::where([
                    ["garage_id",$trans->garage_id],
                    ["day",$car_day]
                ])
            ->first();
            
        $spent = 0;
        if($garageRate->type == 'flat') {
            $trans->total = $garageRate->rate;
        } else {
            $datetime1 = strtotime($trans->closing_time);
            $datetime2 = strtotime($trans->opening_time);
            $interval = ($datetime1-$datetime2)/3600;
            $spent = $interval;//->format('%d');

            $trans->total = ((ceil($interval) - 1) * $garageRate->succeeding_rate) + $garageRate->rate;
        }
        $trans->save();

        $garage = TblGarage::find($trans->garage_id);
        $garage->status = "available";
        $garage->save();
        
        if($trans) return response()->json(['Success! Total fee: '.$trans->total], 200);

        return response()->json(['Unable to process transaction'], 400);
    }

}
