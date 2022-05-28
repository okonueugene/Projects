<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class Task extends Component
{
    public function render()
    {
        $title = "Task Reports";
        $test = 'test';
        return view('livewire.reports.task', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
