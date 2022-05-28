<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'email',
        'company_id',
        'invitation_token',
        'is_admin',
        'registered_at'
    ];

    public function getLink() {
        return urldecode(route('register') . '?invitation_token=' . $this->invitation_token);
    }
}
