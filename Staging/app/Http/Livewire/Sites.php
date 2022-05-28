<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Camroncade\Timezone\Facades\Timezone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sites extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $timezone;
    public $location;
    public $logo;

    public function clearInput(){
        $this->name = "";
        $this->timezone = "";
        $this->location = "";
        $this->logo = "";
    }

    public function addSite()
    {
        $this->validate([
            'name' => 'required',
            'timezone' => 'required',
            'location' =>'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:5048'
        ]);

        $logoname = $this->logo->store('site-logos', 'public');

        $newSite = Site::create([
            'company_id' => Auth::user()->company_id,
            'name' => $this->name,
            'timezone' => $this->timezone,
            'location' => $this->location,
            'logo' => $logoname
        ]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Site added successfully',
        ]);

        $this->clearInput();

        $this->emit('userStore');
    }

    public function deleteSite(Site $site)
    {
        if(auth()->user()->company_id == $site->company_id)
        {
            Storage::disk('public')->delete($site->logo);

            $site->delete();
            
            $this->dispatchBrowserEvent('success', [
                'message' => 'Site deleted successfully',
            ]);
        }
        else{
            $this->dispatchBrowserEvent('error', [
                'message' => 'You don not have the right access role',
            ]);
        }
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
    }
    public function updateSite(Request $request ,Site $site){
    Site::where('id', $site->id)->update([
        'name' => $request->input('name'),
        'logo' => $request->input('logo'),
        'timezone' => $request->input('timezone')
    ]);
    // $site = DB::table('sites')->get();
    // DD($site);
    $this->clearInput();
    $this->dispatchBrowserEvent('success', [
        'message' => 'Site Edited successfully',
    ]);
    return redirect()->route('org.sites.index')->with('success','Site Updated');
    
}
    
    public function render()
    {
        //Timezones
        $selected = 'Africa/Nairobi';
        $placeholder = 'Select a timezone';
        $formAttributes = array('class' => 'form-select timezone wire:model="timezone" form-control form-control-lg', 'style' => '', 'name' => 'timezone');
        $optionAttributes = array('data-search' => 'on');

        $timezones = Timezone::selectForm(
            $selected,
            $placeholder,
            $formAttributes,
            $optionAttributes
        );

        $total = Site::where('company_id', '=', Auth::user()->company_id)->get()->count();

        $sites = Site::orderBy('id', 'desc')->where('company_id', '=', Auth::user()->company_id)->paginate(6);
        

        return view('livewire.sites', compact('sites', 'timezones', 'total'));
    }
}
