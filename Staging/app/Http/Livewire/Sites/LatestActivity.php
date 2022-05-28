<?php

namespace App\Http\Livewire\Sites;
use App\Models\Site;
use Livewire\Component;

class LatestActivity extends Component
{
    public $site; 

    public function mount(Site $site)
    {
        $this->site = $site;
    }
    public function render()
    {
        $title = "Latest Activity";
        return view('livewire.sites.latestactivity')
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}