<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class Attendance extends Component
{
    public function render()
    {
        $title = "Attendance Reports";
        $test = 'test';
        return view('livewire.reports.attendance', compact('test'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}