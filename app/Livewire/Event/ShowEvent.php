<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowEvent extends Component
{
    public $event;

    public function mount(Event $event) 
    {
        if ($event->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        $this->event = $event;
    }

    function edit() 
    {
        $event_id = $this->event->id;
        $this->redirect("/event/$event_id/edit"); 
    }

    function back() 
    {
        $this->redirect('/event'); 
    }

    public function render()
    {
        return view('livewire.event.show-event')
            ->title('Event details');
    }
}
