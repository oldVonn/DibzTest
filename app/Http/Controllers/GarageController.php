<?php

namespace App\Http\Controllers;

use App\Models\TblGarage as Garage;
use App\Models\TblGarage;

use Illuminate\Http\Request;

class GarageController extends Controller
{
    //
    public function index() {
        $garage = TblGarage::all();
        return json_encode($garage);
    }

    public function store(Request $request) {
        $garage = new TblGarage();
        $garage->name = $request->name;
        $garage->description = $request->description;
        $garage->address = $request->address;
        $garage->status = $request->status;

        $garage->save();

        return json_encode($garage);
    }


    public function update(Request $request, $id) {
        print_r($request);
        $garage = TblGarage::find($id);
        $garage->name = $request->name;
        $garage->description = $request->description;
        $garage->address = $request->address;
        $garage->status = $request->status;

        $garage->save();

        return json_encode($garage);
    }

    public function show($id) {
        $garage = TblGarage::findOrFail($id);
        return json_encode($garage);
    }

}
