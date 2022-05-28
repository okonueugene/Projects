<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function suspendUser(User $user)
    {
        if($user->is_active == false)
        {
            $user->is_active = true;
            $user->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'User activated successfully',
            ]);

            $this->user = $user;

        }else
        {
            $user->is_active = false;

            $user->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'User deactivated successfully',
            ]);

            $this->user = $user;
        }

        
    }
    public function render()
    {
        return view('livewire.user-details');
    }
}
