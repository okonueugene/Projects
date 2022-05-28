<?php

namespace App\Http\Livewire\Guards;

use App\Models\Guard;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Guards extends Component
{
    public $name;
    public $email;
    public $phone;
    public $id_no;
    // public $profile;
    public $password;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function clearInput(){
        $this->name = "";
        $this->email = "";
        $this->phone = "";
        $this->id_no = "";
        $this->password = "";
    }

    public function addGuard()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:guards,email',
            'phone' => 'required',
            'id_no' => 'required',
            'password' => 'required|min:6'
        ]);

        $guard = Guard::create([
            'company_id' => auth()->user()->company_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'id_number' => $this->id_no,
            'password' => Hash::make($this->password)
        ]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Guard created successfully',
        ]);

        $this->clearInput();
        

        $this->emit('userStore');

    }
    
    public function render()
    {
        $total = Guard::where('company_id', '=', auth()->user()->company_id)->get()->count();

        $guards = Guard::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->paginate(6);

        return view('livewire.guards.guards', compact('guards', 'total'))
        ->extends('layouts.organization', ['title' => 'Guards Management'])
        ->section('content');
    }
}
