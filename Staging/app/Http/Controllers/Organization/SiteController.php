<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Client;
use Camroncade\Timezone\Facades\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Sites';
        //Timezones
        $selected = 'Africa/Nairobi';
        $placeholder = 'Select a timezone';
        $formAttributes = array('class' => 'form-select timezone wire:model="timezone" form-control form-control-lg', 'style' => '', 'name' => 'timezone');
        $optionAttributes = array('data-search' => 'on');

        $timezones = Timezone::selectForm(
            $selected,
            $placeholder,
            $formAttributes,
            $optionAttributes
        );
        $site = Site::all();
        return view('organization.sites.sites', compact(['timezones', 'timezones', 'title' ,'site']));
    }

    public function viewMap()
    {
        $title = 'Sites Map';
        return view('organization.sites.sites-map', compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {        
        if(!$site){
            return redirect()->route('org.sites.index')->with('error', 'Site unavailable or deleted!');
        }

        return view('organization.sites.site-details', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Site::find($id);
        if ($site) {
            return response()->json([
                'status' => 200,
                'message' => $site,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Site Found.',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        Site::where('id', $site->id)->update([
            'name' => $request->input('name'),
            'logo' => $request->input('logoo'),
            'timezone' => $request->input('time')
        ]);
        
        return redirect()->route('org.site-overview', $site->id)->with('success', 'Site updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateLocation(Request $request, Site $site)
    {
        dd($site);Site::where('id',)->update([
            'location' => $request->input('address_address'),
            'lat' => $request->input('address_latitude'),
            'long' => $request->input('address_longitude')
        ]);

        return redirect()->route('org.site-overview', $site->id)->with('success', 'Location updated successfully');
    }

    public function viewClients()
    {
        $title = 'Client List';
        $students = DB::table('clients')->get();

        return view('organization.sites.clients',compact('title','students'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }  

}
