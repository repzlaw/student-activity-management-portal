<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\TaskForm;
use Illuminate\Support\Facades\Auth;

class CreateTask extends Component
{
    public TaskForm $form;

    public $form_type = 'create';

    public function mount() 
    {
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'task:create')) {
            abort(403);
        }

        $this->form->setUser();
    }

    public function saveTask()
    {
        $this->validate();

        $task = Task::create([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'due_date'    => $this->form->due_date,
            'assigned_to' => $this->form->assigned_to,
            'status'      => 'TO DO',
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        $this->form->reset();

        $this->redirect("/task/$task->id/details");
    }

    function back() 
    {
        $this->redirect('/task'); 
    }

    public function render()
    {
        return view('livewire.task.create-task')
            ->title('Create Task');
    }
}
