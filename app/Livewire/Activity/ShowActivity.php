<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Auth;

class ShowActivity extends Component
{
    public $activity;

    #[On('activity-approval')] 
    public function reloadComponent()
    {
        $this->render();
    }

    public function mount(Activity $activity) 
    {
        if ($activity->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $activity->user_id != Auth::id()) {
            abort(403);
        }

        $this->activity   = $activity;
    }

    function edit() 
    {
        $activity_id = $this->activity->id;
        $this->redirect("/activity/$activity_id/edit"); 
    }

    public function confirmActivityApproval($activity_id, $action_type='Approved')
    {
        $this->dispatch('confirm-approval', [
            'activity_id'=> $activity_id,
            'action_type'=> $action_type,
            'model_type'=> 'activity',
            'button_text'=> 'Approve',
        ]);
    }

    public function confirmActivityRejection($activity_id, $action_type='Rejected')
    {
        $this->dispatch('confirm-approval', [
            'activity_id'=> $activity_id,
            'action_type'=> $action_type,
            'model_type'=> 'activity',
            'button_text'=> 'Reject',
        ]);
    }

    public function confirmActivityAttachmentApproval($activity_id, $action_type='Approved')
    {
        $this->dispatch('confirm-approval', [
            'activity_id'=> $activity_id,
            'action_type'=> $action_type,
            'model_type'=> 'activity attachment',
            'button_text'=> 'Approve',
        ]);
    }

    public function confirmActivityAttachmentRejection($activity_id, $action_type='Rejected')
    {
        $this->dispatch('confirm-approval', [
            'activity_id'=> $activity_id,
            'action_type'=> $action_type,
            'model_type'=> 'activity attachment',
            'button_text'=> 'Reject',
        ]);
    }

    function back() 
    {
        $this->redirect('/activity'); 
    }

    public function render()
    {
        return view('livewire.activity.show-activity')
            ->title('Activity details');
    }
}
