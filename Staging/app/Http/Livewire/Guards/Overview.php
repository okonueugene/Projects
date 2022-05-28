<?php

namespace App\Http\Livewire\Guards;

use App\Models\Guard;
use Livewire\Component;

class Overview extends Component
{
    public $guard;

    public function mount(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function suspendGuard(Guard $guard)
    {
        if($guard->is_active == false)
        {
            $guard->is_active = true;
            $guard->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'Guard activated successfully',
            ]);

        }else
        {
            $guard->is_active = false;
            $guard->save();

            
            $this->dispatchBrowserEvent('success', [
                'message' => 'Guard suspended successfully',
            ]);
        }
        $this->guard = $guard;
    }
    public function render()
    {
        return view('livewire.guards.overview')
        ->extends('layouts.organization', ['title' => 'Guard name'])
        ->section('content');
    }
}
