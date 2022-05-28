<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class Patrol extends Component
{
    public function render()
    {
        $title = "Patrol Reports";
        $test = 'test';
        return view('livewire.reports.patrol', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
