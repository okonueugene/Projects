<?php

namespace App\Http\Livewire;

use App\Models\Site;
use App\Models\User;
use Camroncade\Timezone\Facades\Timezone;
use Livewire\Component;

class SiteDetails extends Component
{
    public $site;
    public $owner;
    public $timezone;

    public function mount($site)
    {
        $this->site = $site;
    }

    public function updateTimezone(Site $site)
    {
        Site::where('id', $this->site->id)->update(['timezone' => $this->timezone]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Timezone updated successfully',
        ]);

        $this->emit('userStore');

        $this->site = $site;
    }

    public function siteOwner(Site $site)
    {
        dd($this->owner);
        Site::where('id', $this->site->id)->update(['user_id' => $this->owner]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Site Owner updated successfully',
        ]);
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

    public function render()
    {

         //Timezones
        //  $selected = 'Africa/Nairobi';
        //  $placeholder = 'Select a timezone';
        //  $formAttributes = array('class' => 'form-select timezone form-control form-control-lg', 'style' => '', 'name' => 'timezone');
        //  $optionAttributes = array('data-search' => 'on');
 
        //  $timezones = Timezone::selectForm(
        //      $selected,
        //      $placeholder,
        //      $formAttributes,
        //      $optionAttributes
        //  );

        $clients = User::where('company_id','=', auth()->user()->company_id)
                    ->where('user_type', '=', 'client')->get();

        return view('livewire.site-details', compact('clients'));
    }
}
