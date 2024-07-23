<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Credential;
use Livewire\Attributes\Validate;

class CredentialForm extends Form
{
    public ?Credential $credential;
        
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required')]
    public $type = '';

    public $description = '';

    public $status = 'Submitted';

    public $issuer = '';
    
    #[Validate('required|date')]
    public $issue_date;

    #[Validate('required|date')]
    public $expire_date;

    // #[Validate(['attachments.*' => 'image|max:5024'])]
    public $attachments = [];

    public function setCredential(Credential $credential)
    {
        $this->credential = $credential;
 
        $this->name = $credential->name;
 
        $this->description = $credential->description;
        
        $this->type = $credential->type;

        $this->issuer = $credential->issuer;

        $this->issue_date = $credential->issue_date->format('Y-m-d');
        
        $this->expire_date = $credential->expire_date->format('Y-m-d');

        $this->attachments = $credential->attachments;
    }

    public function setDates()
    {
        $this->issue_date = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->expire_date = today()->format('Y-m-d');
    }

}
