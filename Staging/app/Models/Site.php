<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuperAdmin\Company;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';

    protected $fillable = [
        'name',
        'logo',
        'location',
        'lat',
        'long',
        'company_id',
        'timezone',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function guards()
    {
        return $this->hasMany(Guard::class,'site_id');
    }

    public function patrols(){
        return $this->hasMany(Patrol::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function incidents(){
        return $this->hasMany(Incident::class,'site_id');
    }
    public function setting() {
        return $this->hasOne(SiteSetting::class, 'site_id');
    }
}
