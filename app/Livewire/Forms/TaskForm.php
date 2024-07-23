<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Task;
use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class TaskForm extends Form
{
    public ?Task $task;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required')]
    public $type = '';

    public $description = '';

    public $status = 'TO DO';

    #[Validate('required|date')]
    public $due_date;

    public $assigned_to = '';

    public $userOptions = [];

    // #[Validate('required|date')]
    // public $complete_date;

    public function setTask(Task $task)
    {
        $this->task = $task;

        $this->name = $task->name;

        $this->description = $task->description;

        $this->type = $task->type;

        $this->due_date = $task->due_date->format('Y-m-d H:i:s');

        $this->assigned_to = $task->assigned_to;

    }

    public function setUser()
    {

        $users = Auth::user()->currentTeam->allUsers();
        $sortedUsers = $users->sortBy('name');

        
        $this->userOptions = $sortedUsers->values();
        // $this->userOptions = Auth::user()->currentTeam->allUsers();

    }
}
