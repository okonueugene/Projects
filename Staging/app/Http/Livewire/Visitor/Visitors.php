<?php

namespace App\Http\Livewire\Visitor;

use Livewire\Component;

class Visitors extends Component
{
    public function render()
    {
        $title = "Visitors Management";
        $test = 'test';
        return view('livewire.visitor.visitors', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
