<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;

class ApiController extends Controller
{
    public function fetchSites(Request $request)
    {
        
        $sites = Site::select('id', 'name', 'location', 'timezone');
        // $query = Site::select('first_name', 'last_name', 'email');
        return datatables($sites)->make(true);
    }
}
