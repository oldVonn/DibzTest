<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblTransaction extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'day',
        'opening_time',
        'closing_time',
        'total',
        'car_in_by_user_id',
        'car_out_by_user_id',
        'succeeding_rate',
        'garage_id'
    ];
}
