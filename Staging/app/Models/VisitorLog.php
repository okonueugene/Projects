<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor',
        'time-in',
        'time-out',
        'checked_in_by',
        'checked_out_by',
        'status',
    ];
}
