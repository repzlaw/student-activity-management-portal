<?php

namespace App\Livewire\Activity;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithFileUploads;
use App\Models\ActivityAttachment;
use App\Livewire\Forms\ActivityForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditActivity extends Component
{
    use WithFileUploads;
    
    public ActivityForm $form;

    public $activity;

    public $form_type = 'update';

    public function mount(Activity $activity) 
    {
        if ($activity->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $activity->user_id != Auth::id()) {
            abort(403);
        }

        $this->form->setActivity($activity);

        $this->activity = $activity;
    }

    public function saveActivity()
    {
        $this->validate();

        $activity_id = $this->form->activity->id;

        $this->form->activity->update([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'status'      => 'Submitted',
            'provider'    => $this->form->provider,
            'start_date'  => $this->form->start_date,
            'end_date'    => $this->form->end_date,
            'hours'       => $this->form->hours,
        ]);

        if(count($this->form->attachments)) {
            if(!isset($this->form->attachments[0]->id)){

                // Iterate through each attachment and delete it
                foreach ($this->activity->attachments as $attachment) {
                    // Delete the file from the storage
                    Storage::delete($attachment->filename);
                    // Delete the attachment record
                    $attachment->delete();
                }

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
                        'activity_id' => $activity_id,
                        'type'        => $fileType,
                    ]);
                }
            }

        }

        $this->form->reset();
        $this->redirect("/activity/$activity_id/details");

    }

    function back() 
    {
        $this->redirect('/activity'); 
    }

    public function render()
    {
        return view('livewire.activity.create-activity')
            ->title('Update Activity');
    }
}
