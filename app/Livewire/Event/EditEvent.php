<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use App\Livewire\Forms\EventForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditEvent extends Component
{
    public EventForm $form;

    public $event;

    public $form_type = 'update';

    public function mount(Event $event) 
    {
        if ($event->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $event->user_id != Auth::id()) {
            abort(403);
        }

        $this->form->setEvent($event);

        $this->event = $event;
    }

    public function saveEvent()
    {
        $this->validate();

        $eventId = $this->form->event->id;

        $this->form->event->update([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'location'    => $this->form->location,
            'start_date'  => $this->form->start_date,
            'end_date'    => $this->form->end_date,
        ]);

        $this->form->reset();
        $this->redirect("/event/$eventId/details");

    }

    function back() 
    {
        $this->redirect('/event'); 
    }

    public function render()
    {
        return view('livewire.event.create-event')
            ->title('Update Event');
    }
}
