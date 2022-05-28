<?php

namespace App\Http\Livewire\Sites;

use App\Models\Guard;
use App\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Guards extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $site;
    public $search;
    protected $listeners = ['delete'];

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function addtoSite(Guard $guard)
    {
        if(!empty($guard->site_id))
        {
            $guard->site()->dissociate($this->site);

            $guard->save();

            // $this->dispatchBrowserEvent('success', [
            //     'message' => 'Guard unassigned from site successfully',
            // ]);
            $this->dispatchBrowserEvent('swal:success', [
                'title' => 'Successful!',
                'type' => 'success',
                'message' => 'Guard unassigned from site successfully',
                'text' => ''
            ]);

        }
        elseif(empty($guard->site_id))
        {
            $guard->site()->associate($this->site);

            $guard->save();

            
            // $this->dispatchBrowserEvent('success', [
            //     'message' => 'Guard assigned to site successfully',
            // ]);
            $this->dispatchBrowserEvent('swal:success', [
                'title' => 'Successful!',
                'type' => "success",
                'message' => 'Guard assigned to site successfully',
                'text' => ''
            ]);
        }

    }

    public function deleteConfirm(Guard $guard)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Are you sure?',
            'type' => "warning",
            'message' => 'You wont be able to revert this action!',
            'confirmButtonText' => 'Yes Dissociate',
            'id' => $guard
        ]);
    }

    public function delete(Guard $guard)
    {
        $guard->site()->dissociate($this->site);

        $guard->save();

        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Successful!',
            'type' => 'success',
            'message' => 'Guard unassigned from site successfully',
            'text' => ''
        ]);
    }

    public function render()
    {  
        $title = $this->site->name; 

        $total = Guard::where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get()->count();

        $guardsAssigned = Guard::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->paginate(5);

        $allGuards = Guard::where('site_id', '=', $this->site->id)->orWhereNull('site_id')->when($this->search, function($query, $term){
            return $query->where('name', 'like', "%$term%");
            })->paginate(20);
        // dd($allGuards);

        return view('livewire.sites.guards', compact('total', 'guardsAssigned', 'allGuards'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
