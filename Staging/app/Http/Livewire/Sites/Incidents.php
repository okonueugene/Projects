<?php

namespace App\Http\Livewire\Sites;
use App\Models\Site;
use App\Models\Incident;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Incidents extends Component
{
    public $site; 
    public $incident_no;
    public $police_ref;
    public $title;
    public $date;
    public $reported_by;
    public $status;

    public function mount(Site $site)
    {
        $this->site = $site;
        
    }
    public function clearInput(){
        $this->incident_no = "";
        $this->police_ref = "";
        $this->title = "";
        $this->date = "";
        $this->reported_by = "";

    }
    
    public function addIncident()
    {
        $this->validate([
            'incident_no' => 'required',
            'police_ref' => 'required',
            'title' =>'required',
            'date' => 'required',
            'reported_by' => 'required'
        ]);

        Incident::create([
            'incident_no' => $this->incident_no,
            'police_ref' => $this->police_ref,
            'title' => $this->title,
            'date' => $this->date,
            'reported_by' => $this->reported_by,
        ]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Incident Added successfully',
        ]);

        $this->clearInput();
        $this->emit('userStore');

    }
    public function deleteIncident(Incident $incident)
        {
            $incident->delete();
    
            $this->dispatchBrowserEvent('success', [
                'message' => 'Task deleted successfully',
            ]);
        }
    
    public function render(Incident $incident)
    {
        
        // $site= Site::all();
        //     DD($site->find($this->site->id)->incidents->all());
        $title = "Incidents";
        $incidences = Incident::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', $this->site->id)->paginate(10);
        return view('livewire.sites.incidents', compact('incidences'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}