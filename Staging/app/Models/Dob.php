<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dob extends Model
{
    use HasFactory;
    protected $fillable = [
        'dob_no',
        'date',
        'time',
        'guard',
        'time_duty_start',
    ];
}
