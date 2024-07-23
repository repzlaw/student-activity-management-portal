<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GetTask extends Component
{
    public function createTaskPage()
    {
        $this->redirect('/task/create');
    }

    public function render()
    {
        $user   = Auth::user();
        $teamId = $user->currentTeam->id;

        $taskExists = Task::where('team_id', $teamId)
            ->when(!$user->hasTeamPermission($user->currentTeam, 'team:update'), function ($query) use ($user) {
                $query->where('assigned_to', '>=', $user->id);
            })
            ->exists();

        return view('livewire.task.get-task', [
            'taskExists' => $taskExists,
        ])
        ->title('Tasks');
    }
}
