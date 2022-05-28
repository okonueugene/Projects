<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Auth;
use Livewire\WithPagination;

class Team extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteUser(User $user)
    {
        if($user->id == auth()->user()->id){
            $this->dispatchBrowserEvent('error', [
                'message' => 'User cannot delete their own account',
            ]);
        }else{
            if(auth()->user()->company_id == $user->company_id)
            {

                $user->delete();
                
                $this->dispatchBrowserEvent('success', [
                    'message' => 'User deleted successfully',
                ]);
            }
            else{
                $this->dispatchBrowserEvent('error', [
                    'message' => 'You don not have the right access role',
                ]);
            }
        }
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

        }else
        {
            $user->is_active = false;
            $user->save();

            $this->dispatchBrowserEvent('success', [
                'message' => 'User deactivated successfully',
            ]);
        }
    }

    public function render()
    {
        $total = User::where('company_id', '=', auth()->user()->company_id)->get()->count();

        $users = User::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->paginate(5);

        return view('livewire.team', compact('users', 'total'));
    }
}
