<?php

namespace App\Http\Livewire\Sites;

use App\Models\Guard;
use App\Models\Patrol;
use App\Models\Site;
use App\Models\Tag;
use Livewire\Component;

class CreatePatrol extends Component
{
    public $site;
    public $guard;
    public $round_name;
    public $start_time;
    public $end_time;
    public $tags = [];


    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function guardDetails()
    {
        return Guard::where('id', $this->guard)->pluck('name');
    }

    public function clearInput(){
        $this->guard = "";
        $this->round_name = "";
        $this->start_time = "";
        $this->end_time = "";
        $this->tags = [];
    }

    public function createPatrol(){
        $this->validate([
            'round_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'guard' => 'required'
        ]);

        $patrol = Patrol::create([
            'company_id' => auth()->user()->company_id,
            'site_id' => $this->site->id,
            'guard_id' => $this->guard,
            'name' => $this->round_name,
            'start' => $this->start_time,
            'end' => $this->end_time
        ]);

        $patrol->tags()->attach($this->tags);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Patrol created successfully',
        ]);

        $this->clearInput();
        return redirect()->route('org.site-patrols', $this->site->id)->with('success', 'Patrol Created successfully');
    
    }

    public function render()
    {
        $title = $this->site->name;

        $siteguards = Guard::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get();

        $sitetags = Tag::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get();

        return view('livewire.sites.create-patrol', compact('siteguards', 'sitetags'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
