<?php

namespace App\Http\Livewire;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Notifications\MemberInvitation;
use Livewire\Component;
use Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class Invitations extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $email;
    public $role;

    public function clearInput(){
        $this->email = "";
        $this->role = "";
    }

    public function inviteMember()
    {
        $this->validate([
            'email' => 'required|email|unique:invitations'
        ]);

        $token = substr(md5(rand(0, 9) . $this->email . $this->role . time()), 0, 32);

        $newInvite = Invitation::create([
            'email' => $this->email,
            'is_admin' => $this->role,
            'company_id' => auth()->user()->company_id,
            'invitation_token' => $token,
        ]);

        $this->dispatchBrowserEvent('success', [
            'message' => 'Invitation link generated successfully',
        ]);

        $this->emit('userStore');

        $this->clearInput();
    }

    public function deleteInvite(Invitation $invitation)
    {
        if(auth()->user()->company_id == $invitation->company_id)
        {

            $invitation->delete();
            
            $this->dispatchBrowserEvent('success', [
                'message' => 'Invitation deleted successfully',
            ]);
        }
        else{
            $this->dispatchBrowserEvent('error', [
                'message' => 'You don not have the right access role',
            ]);
        }
    }

    
    public function render()
    {
        $invitations = Invitation::orderBy('created_at', 'desc')
        ->where('company_id', '=', auth()->user()->company_id)
        ->where('registered_at', null)
        ->paginate(6);

        return view('livewire.invitations', compact('invitations'));
    }
}
