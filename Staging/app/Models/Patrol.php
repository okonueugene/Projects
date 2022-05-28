<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrol extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'company_id',
        'site_id',
        'guard_id'
    ];

    //Changed relationship to owner because guard is reserved keyword
    public function owner(){
        return $this->belongsTo(Guard::class, 'guard_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
