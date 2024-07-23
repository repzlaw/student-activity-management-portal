<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Activity;
use Livewire\Attributes\Validate;

class ActivityForm extends Form
{
    public ?Activity $activity;
        
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required')]
    public $type = '';

    public $description = '';

    public $status = 'Submitted';

    public $provider = '';
    
    #[Validate('required')]
    public $hours = '';
    
    #[Validate('required|date')]
    public $start_date;

    #[Validate('required|date')]
    public $end_date;

    // #[Validate(['attachments.*' => 'image|max:5024'])]
    public $attachments = [];

    public function setActivity(Activity $activity)
    {
        $this->activity = $activity;
 
        $this->name = $activity->name;
 
        $this->description = $activity->description;
        
        $this->type = $activity->type;

        $this->provider = $activity->provider;

        $this->start_date = $activity->start_date->format('Y-m-d');
        
        $this->end_date = $activity->end_date->format('Y-m-d');

        $this->hours = $activity->hours;

        $this->attachments = $activity->attachments;

    }

    public function setDates()
    {
        $this->start_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
    }

}
