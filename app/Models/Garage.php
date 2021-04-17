<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TblGarage;

class Garage extends Model
{
    use HasFactory;

    function __construct(){

    }

    public function index(){
        $garage = TblGarage::all();
        dd($garage);
    }

}
