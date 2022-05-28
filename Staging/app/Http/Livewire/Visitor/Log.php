<?php

namespace App\Http\Livewire\Visitor;

use Livewire\Component;

class Log extends Component
{
    public function render()
    {
        $title = "Visitors Log";
        $test = 'test';
        return view('livewire.visitor.log', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
