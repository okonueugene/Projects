<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'incident_no',
        'police_ref',
        'title',
        'date',
        'reported_by',
    ];
    public function siteIncident(){
        return $this->belongsTo(Site::class, 'site_id');
    }
}
