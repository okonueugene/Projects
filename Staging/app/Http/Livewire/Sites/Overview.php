<?php

namespace App\Http\Livewire\Sites;

use App\Models\Guard;
use App\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Overview extends Component
{
    public $site;
    public $owner;
    public $timezone;

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function render()
    {
        $total = Guard::where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get()->count();

        return view('livewire.sites.overview', compact('total'))
        ->extends('layouts.organization', ['title' => $this->site->name])
        ->section('content');
    }
}
