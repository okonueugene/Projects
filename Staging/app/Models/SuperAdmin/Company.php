<?php

namespace App\Models\SuperAdmin;
use App\Models\User;
use App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;



    public function users(){
        return $this->hasMany(User::class);
    }

    public function sites(){
        return $this->hasMany(Site::class);
    }
}
