<?php

namespace App\Http\Livewire\Sites;

use App\Models\Site;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Tags extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteCSingleRecord'];

    public $site;
    public $value;
    public $number;
    public $data= [];
    public $checked= [];

    //Sinngle Tag
    public $name;
    public $type;
    public $location;
    public $code;
    public $lat;
    public $long;

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function clearInput(){
        $this->name = "";
        $this->location = "";
        $this->code = "";
        $this->lat = "";
        $this->long = "";
        $this->value = "";
        $this->number = "";
    }

    public function generateCode()
    {
        $this->value = Str::random(30);

        $this->setCode($this->value);
    }

    public function setCode($value)
    {
        $this->code = $value;
    }

    public function addSingleTag()
    {

        $this->validate([
            'name' => 'required',
            'location' => 'required',
            'code' => 'required',
        ]);

        $tag = Tag::create([
            'company_id' => auth()->user()->company_id,
            'site_id' => $this->site->id,
            'name' => $this->name,
            'type' => 'qr',
            'code' => $this->code,
            'location' => $this->location,
            'lat' => $this->lat,
            'long' => $this->long
        ]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Tag created successfully',
        ]);

        $this->clearInput();
        

        $this->emit('userStore');
    }

    public function addMultipleTags()
    {
        $this->validate([
            'number' => 'required'
        ]);

        $this->data = [];

        for($i=0;$i<$this->number;$i++)
        {
            $data[$i] = Str::random(30);
        }

        foreach ($data as $code) {
            Tag::create([
                'company_id' => auth()->user()->company_id,
                'site_id' => $this->site->id,
                'type' => 'qr',
                'code' => $code
            ]);
        }

        $this->clearInput();

        $this->dispatchBrowserEvent('success', [
            'message' => 'Tags generated successfully',
        ]);

        $this->emit('userStore');
    }

    public function deleteRecords()
    {
        Tag::whereKey($this->checked)->delete();

        $this->checked = [];

        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Successful!',
            'type' => 'success',
            'message' => 'Records deleted successfully',
            'text' => ''
        ]);
    }

    public function deleteSingleRecord(Tag $tag)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Are you sure?',
            'type' => "warning",
            'message' => 'You wont be able to revert this action!',
            'confirmButtonText' => 'Yes, Delete',
            'id' => $tag
        ]);
    }

    public function deleteCSingleRecord(Tag $tag)
    {
        $tag->delete();

        $this->dispatchBrowserEvent('swal:success', [
            'title' => 'Successful!',
            'type' => 'success',
            'message' => 'Tag deleted successfully',
            'text' => ''
        ]);
    }

    public function isChecked($tag_id)
    {
        return in_array($tag_id, $this->checked);
    }

    public function getDetails()
    {
        return Tag::select('code', 'id')->wherein('id', $this->checked)->get();
    }

    public function exportPDF()
    {
        
    }


    public function render()
    {
        $title = $this->site->name;

        $total = Tag::where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get()->count();

        $tags = Tag::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->paginate(10);

        return view('livewire.sites.tags', compact('tags', 'total'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
