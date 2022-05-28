<?php

namespace App\Http\Livewire\Sites;

use App\Models\Dob;
use App\Models\Site;
use Livewire\Component;

class Dobs extends Component
{

    public $site; 
    public $dob_no;
    public $police_ref;
    public $time;
    public $date;
    public $guard;
    public $time_duty_start;


    public function mount(Site $site)
        {
            $this->site = $site;
        }
        public function clearInput(){
            $this->dob_no = "";
            $this->time = "";
            $this->date = "";
            $this->guard = "";
            $this->time_duty_start = "";
    
        }
        
        public function addDob()
        {
            $this->validate([
                'dob_no' => 'required',
                'time' =>'required',
                'date' => 'required',
                'guard' => 'required',
                'time_duty_start' => 'required'
            ]);
    
            Dob::create([
                'dob_no' => $this->dob_no,
                'time' => $this->time,
                'date' => $this->date,
                'guard' => $this->guard,
                'time_duty_start' => $this->time_duty_start,
            ]);
    
            $this->dispatchBrowserEvent('success', [
                'message' => 'Occurence Added successfully',
            ]);
    
            $this->clearInput();
            $this->emit('userStore');
    
        }
        public function deleteDob(DOB $dob)
        {
            $dob->delete();
    
            $this->dispatchBrowserEvent('success', [
                'message' => 'Task deleted successfully',
            ]);
        }
    

    public function render()
    {
        $title = "Daily Occurrence Book";
        $dobs=Dob::all();
        return view('livewire.sites.dobs', compact('dobs'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
