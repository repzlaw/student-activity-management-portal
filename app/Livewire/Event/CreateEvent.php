<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use App\Livewire\Forms\EventForm;
use Illuminate\Support\Facades\Auth;

class CreateEvent extends Component
{
    public EventForm $form;

    public $form_type = 'create';

    public function mount() 
    {
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'event:create')) {
            abort(403);
        }

        $this->form->setDates();
    }

    public function saveEvent()
    {
        $this->validate();

        $event = Event::create([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'location'    => $this->form->location,
            'start_date'  => $this->form->start_date,
            'end_date'    => $this->form->end_date,
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        $this->form->reset();

        $this->redirect("/event/$event->id/details");
    }

    function back() 
    {
        $this->redirect('/event'); 
    }

    public function render()
    {
        return view('livewire.event.create-event')
            ->title('Create Event');
    }
}
