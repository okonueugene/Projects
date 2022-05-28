<?php

namespace App\Http\Livewire\Sites;

use App\Models\Patrol;
use App\Models\Site;
use Livewire\Component;

class Patrols extends Component
{

    public $site;
    public $name;
    public $start;
    public $end;
    public $guard;
    public $checked = [];

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function showPatrolDetails($id)
    {

        $patrol = Patrol::where('id', $id)->first();

        $this->patrol_id = $id;
        $this->name = $patrol->name;
        $this->start = $patrol->start;
        $this->end = $patrol->end;
        $this->guard = $patrol->owner->name;
    }

    public function deletePatrols(){

        Patrol::whereKey($this->checked)->delete();

        $this->checked = [];

        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Successful!',
            'type' => 'success',
            'message' => 'Patrols deleted successfully',
            'text' => ''
        ]);
    }

    public function deletePatrol($id)
    {
        $patrol = Patrol::where('id', $id);
        
        $patrol->delete();

        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Successful!',
            'type' => 'success',
            'message' => 'Patrol deleted successfully',
            'text' => ''
        ]);
    }
    

    public function render()
    {
        $patrols = Patrol::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get();
        
        $title = $this->site->name;

        return view('livewire.sites.patrols', compact('patrols'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
