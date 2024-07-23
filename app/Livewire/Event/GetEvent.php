<?php

namespace App\Livewire\Event;

use Carbon\Carbon;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GetEvent extends Component
{
    public function createEventPage()
    {
        $this->redirect('/event/create');
    }

    public function render()
    {
        $user   = Auth::user();
        $teamId = $user->currentTeam->id;

        $eventExists = Event::where('team_id', $teamId)
            ->when(!$user->hasTeamPermission($user->currentTeam, 'team:update'), function ($query) {
                $query->where('end_date', '>=', Carbon::now());
            })
            ->exists();

        return view('livewire.event.get-event', [
            'eventExists' => $eventExists,
        ])
        ->title('Events');
    }
}
