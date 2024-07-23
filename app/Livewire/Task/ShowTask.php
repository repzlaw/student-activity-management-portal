<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ShowTask extends Component
{
    public $task;

    public function mount(Task $task) 
    {
        if ($task->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $task->assigned_to != Auth::id()) {
            abort(403);
        }

        $this->task = $task;
    }

    function edit() 
    {
        $task_id = $this->task->id;
        $this->redirect("/task/$task_id/edit"); 
    }

    public function goToTask()
    {
        if($this->task->modelable_type == 'App\Models\Activity'){
            $this->redirect('/activity'.'/'.$this->task->modelable->id.'/details');
        } else {
            $this->redirect('/credential'.'/'.$this->task->modelable->id.'/details');
        }
    }

    public function setStatusForm($task_id)
    {
        $this->dispatch('confirm-set-status', [
            'task_id'=> $task_id,
        ]);
    }

    #[On('set-status')] 
    public function setStatus($status)
    {
        $this->task->update([
            'status'        => $status,
            'complete_date' => $status == 'COMPLETED' ? now() : null
        ]);

        $this->render();
    }

    function back() 
    {
        $this->redirect('/task'); 
    }

    public function render()
    {
        return view('livewire.task.show-task')
            ->title('Task details');
    }
}
