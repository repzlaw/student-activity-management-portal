<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use App\Livewire\Forms\TaskForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditTask extends Component
{
    public TaskForm $form;

    public $task;

    public $form_type = 'update';

    public function mount(Task $task) 
    {
        if ($task->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $task->user_id != Auth::id()) {
            abort(403);
        }

        $this->form->setTask($task);
        $this->form->setUser();

        $this->task = $task;
    }

    public function saveTask()
    {
        $this->validate();

        $task_id = $this->form->task->id;

        $this->form->task->update([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'due_date'    => $this->form->due_date,
            'assigned_to' => $this->form->assigned_to,
        ]);

        $this->form->reset();
        $this->redirect("/task/$task_id/details");

    }

    function back() 
    {
        $this->redirect('/task'); 
    }

    public function render()
    {
        return view('livewire.task.create-task')
            ->title('Update Task');
    }
}
