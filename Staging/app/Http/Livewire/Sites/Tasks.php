<?php

namespace App\Http\Livewire\Sites;

use App\Models\Guard;
use App\Models\Site;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $site;
    public $guard;
    public $title;
    public $from;
    public $to;
    public $description;
    public $checked = [];

    public $start;
    public $end;
    public $diff;
    public $pick_from;

    public function mount(Site $site)
    {
        $this->site = $site;
    }

    public function clearInputFields()
    {
        $this->guard = "";
        $this->title = "";
        $this->from = "";
        $this->to = "";
        $this->description = "";
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required',
            'guard' => 'required',
            'from' => 'required',
            'to' => 'required',
            'description' => 'required',
        ]);

        $this->start = date('H:i', strtotime($this->from));
        $this->end = date('H:i', strtotime($this->to));

        $this->diff = $this->start > $this->end;

        

        if($this->from > $this->to){
           $this->addError('oops', 'End time must be greater tha start time');
        }
        else{
            $task = Task::create([
                'company_id' => auth()->user()->company_id,
                'site_id' => $this->site->id,
                'guard_id' => $this->guard,
                'title' => $this->title,
                'from' => $this->from,
                'to' => $this->to,
                'description' => $this->description
            ]);

            $this->dispatchBrowserEvent('success', [
                'message' => 'Task created successfully',
            ]);
    
            $this->clearInputFields();
            $this->emit('userStore');
        }

    }

    public function deleteTask(Task $task)
    {
        $task->delete();

        $this->dispatchBrowserEvent('success', [
            'message' => 'Task deleted successfully',
        ]);
    }

    public function updateTask(Task $task)
    {
        if($task->status == 'pending'){
            $task->update([
                'status' => 'completed'
            ]);
        }
        else{
            $task->update([
                'status' => 'pending'
            ]);
        }
    }

    public function render()
    {
        $title = "Tasks Management";

        $siteguards = Guard::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', '=', $this->site->id)->get();

        $tasks = Task::orderBy('id', 'desc')->where('company_id', '=', auth()->user()->company_id)->where('site_id', $this->site->id)->paginate(10);

        return view('livewire.sites.tasks', compact('siteguards', 'tasks'))
        ->extends('layouts.organization', ['title'=> $title])
        ->section('content');
    }
}
