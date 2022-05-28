<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use Livewire\Component;

class Notifications extends Component
{

    public $site;

    public function mount(Site $site)
    {
        $this->site = $site;
    }
    public function render()
    {
        $title = "{$this->site->name} Notifications";

        return view('livewire.sites.notifications')
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
