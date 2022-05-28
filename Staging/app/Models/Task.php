<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'guard_id',
        'site_id',
        'title',
        'description',
        'from',
        'to',
        'status'
    ];

    public function owner(){
        return $this->belongsTo(Guard::class, 'guard_id');
    }

}
