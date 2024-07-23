<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithFileUploads;
use App\Models\ActivityAttachment;
use App\Livewire\Forms\ActivityForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreateActivity extends Component
{
    use WithFileUploads;
    
    public ActivityForm $form;

    public $form_type = 'create';

    public function mount() 
    {
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'activity:create')) {
            abort(403);
        }

        $this->form->setDates();
    }

    public function saveActivity()
    {
        $this->validate();

        $user = Auth::user();

        $activity = Activity::create([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'status'      => 'Submitted',
            'provider'    => $this->form->provider,
            'start_date'  => $this->form->start_date,
            'end_date'    => $this->form->end_date,
            'hours'       => $this->form->hours,
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        foreach ($this->form->attachments as $attachment) {
            $attachment->store(path: 'activity');
            $size = $attachment->getSize();
            $path = $attachment->store('activity', 'public');
            $url = Storage::url($path);
            $fileType = $attachment->getMimeType();

            ActivityAttachment::create([
                'filename'    => $path,
                'status'      => 'Submitted',
                'size'        => $size,
                'url'         => $url,
                'activity_id' => $activity->id,
                'type'        => $fileType,
            ]);

        }

        $activity->task()->create([
            'name'        => 'Review Activity',
            'type'        => $this->form->type,
            'description' => "Review activity submitted by ". ($user->name ?? $user->id),
            'due_date'    => now()->addDays(7),
            'assigned_to' => Auth::user()->currentTeam->owner->id ?? null,
            'status'      => 'TO DO',
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        $this->form->reset();

        $this->redirect("/activity/$activity->id/details");

    }

    function back() 
    {
        $this->redirect('/activity'); 
    }

    public function render()
    {
        return view('livewire.activity.create-activity')
            ->title('Create Activity');
    }
}
