<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class Visitor extends Component
{
    public function render()
    {
        $title = "Visitor Reports";
        $test = 'test';
        return view('livewire.reports.visitor', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}