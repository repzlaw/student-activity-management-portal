<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class GetActivity extends Component
{
    public function createActivityPage()
    {
        $this->redirect('/activity/create');
    }

    public function render()
    {
        $user   = Auth::user();
        $teamId = $user->currentTeam->id;

        $activityExists = Activity::where('team_id', $teamId)
            ->when(!$user->hasTeamPermission($user->currentTeam, 'team:update'), function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->exists();

        return view('livewire.activity.get-activity', [
            'activityExists' => $activityExists,
        ])
        ->title('Activities');
    }
}
