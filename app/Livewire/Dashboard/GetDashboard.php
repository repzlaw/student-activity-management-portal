<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Event;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Credential;
use Illuminate\Support\Facades\Auth;

class GetDashboard extends Component
{
    public $registeredUsersCount = 0;

    public $eventCount = 0;

    public $activeUsers = 0;

    public $activityCount = 0;

    public $taskCount = 0;


    public function mount() 
    {
        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:dashboard')) {
            $this->adminDashboard();
        } else {
            $this->userDashboard();
        }
    }

    public function adminDashboard() 
    {
        $user = Auth::user();

        // registered users count
        $this->registeredUsersCount = count($user->currentTeam->allUsers());

        //get active users count
        $this->activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(30))->count();

        // events count
        $this->eventCount = Event::where('team_id', $user->currentTeam->id)
            ->where('end_date', '>=', Carbon::now())
            ->count();
    }

    public function userDashboard() 
    {
        $user = Auth::user();

        //activity hours sum
        $this->activityCount = Activity::where('user_id', $user->id)
                                ->whereYear('start_date', now()->year)
                                ->sum('hours');

        //Task count
        $this->taskCount = Task::where([
                                    'team_id'     => Auth::user()->currentTeam->id,
                                    'assigned_to' => Auth::id(),
                                    ['status', '!=', 'COMPLETED']
                                ])->count();

        //get active users count
        $this->activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(30))->count();

        // events count
        $this->eventCount = Event::where('team_id', $user->currentTeam->id)
            ->where('end_date', '>=', Carbon::now())
            ->count();
    }

    public function studentDashboard() 
    {
    }

    public function render()
    {
        return view('livewire.dashboard.get-dashboard')
            ->title('Dashboard');
    }
}
