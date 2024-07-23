<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Event;
use Livewire\Attributes\Validate;

class EventForm extends Form
{
    public ?Event $event;
        
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required')]
    public $type = '';

    public $description = '';

    public $location = '';
    
    #[Validate('required|date')]
    public $start_date;

    #[Validate('required|date')]
    public $end_date;

    // #[Validate(['attachments.*' => 'image|max:5024'])]
    public $attachments = [];

    public function setEvent(Event $event)
    {
        $this->event = $event;
 
        $this->name = $event->name;
 
        $this->description = $event->description;
        
        $this->type = $event->type;

        $this->location = $event->location;

        $this->start_date = $event->start_date->format('Y-m-d H:i:s');
        
        $this->end_date = $event->end_date->format('Y-m-d H:i:s');
    }

    public function setDates()
    {
        $this->start_date = today()->format('Y-m-d H:i:s');
        $this->end_date = null;
    }

}
