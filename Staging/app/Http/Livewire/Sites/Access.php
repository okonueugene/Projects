<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Access extends Component
{
    public $site;
    public $owner;

    public bool $isActive;

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function activateSite(Site $site)
    {
        if($site->is_active == false)
        {
            $site->is_active = true;
            $site->save();
            

            $this->dispatchBrowserEvent('success', [
                'message' => 'Site activated successfully',
            ]);

        }else
        {
            $site->is_active = false;
            $site->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'Site deactivated successfully',
            ]);
        }

        $this->site = $site;
    }

    public function autoReports(Site $site){
        $site->is_active = true;
            $site->save();
    }

    public function portalAccess(Site $site)
    {
        if($site->portal_access == false)
        {
            $site->portal_access = true;
            $site->save();
            

            $this->dispatchBrowserEvent('success', [
                'message' => 'Access granted successfully',
            ]);

        }else
        {
            $site->portal_access = false;
            $site->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'Access revoked successfully',
            ]);
        }

        $this->site = $site;
    }

    public function render()
    {
        return view('livewire.sites.access')
        ->extends('layouts.organization', ['title' => $this->site->name])
        ->section('content');
    }
}
