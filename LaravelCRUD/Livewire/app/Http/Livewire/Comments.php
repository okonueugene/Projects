<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $comments = [

     [
        'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde sit delectus aliquid aut, cum dolorem labore minima! Temporibus, voluptatem molestias.',
        'created_at' => '3 mins ago',
        'creator' => 'Sarthak'
         
          


     ]


    ];
    public function render()
    {
        return view('livewire.comments');
    }
}
