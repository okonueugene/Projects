<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_id',
        'id_number',
        'is_active',
        'password',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function patrols() 
    {
        return $this->hasMany(Patrol::class);
    }

    //Search guards
    public function scopeSearch($query, $term)
    {
        $term = "%term%";
        $query->where(function($query) use ($term){
            $query->where('name', 'like', $term)
            ->orWhere('id_number', 'like', $term)
            ->orWhere('phone', 'like', $term)
            ->orWhere('email', 'like', $term);
        });
    }
}
