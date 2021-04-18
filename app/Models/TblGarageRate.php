<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TblGarageRate extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'day',
        'opening_time',
        'closing_time',
        'type',
        'rate',
        'status',
        'succeeding_rate',
        'garage_id'
    ];
}
