<?php

namespace App\Livewire\Credential;

use Livewire\Component;
use App\Models\Credential;
use Livewire\WithFileUploads;
use App\Models\CredentialAttachment;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\CredentialForm;
use Illuminate\Support\Facades\Storage;

class CreateCredential extends Component
{
    use WithFileUploads;
    
    public CredentialForm $form;

    public $form_type = 'create';

    public function mount() 
    {
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'credential:create')) {
            abort(403);
        }

        $this->form->setDates();
    }

    public function saveCredential()
    {
        $this->validate();
        
        $user = Auth::user();

        $credential = Credential::create([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'status'      => 'Submitted',
            'issuer'    => $this->form->issuer,
            'issue_date'  => $this->form->issue_date,
            'expire_date'    => $this->form->expire_date,
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        foreach ($this->form->attachments as $attachment) {
            $attachment->store(path: 'credential');
            $size = $attachment->getSize();
            $path = $attachment->store('credential', 'public');
            $url = Storage::url($path);
            $fileType = $attachment->getMimeType();

            CredentialAttachment::create([
                'filename'    => $path,
                'status'      => 'Submitted',
                'size'        => $size,
                'url'         => $url,
                'credential_id' => $credential->id,
                'type'        => $fileType,
            ]);

        }

        $credential->task()->create([
            'name'        => 'Review Credential',
            'type'        => $this->form->type,
            'description' => "Review credential submitted by ". ($user->name ?? $user->id),
            'due_date'    => now()->addDays(7),
            'assigned_to' => Auth::user()->currentTeam->owner->id ?? null,
            'status'      => 'TO DO',
            'user_id'     => Auth::id(),
            'team_id'     => Auth::user()->currentTeam->id ?? null,
        ]);

        $this->form->reset();

        $this->redirect("/credential/$credential->id/details");

    }

    function back() 
    {
        $this->redirect('/credential'); 
    }

    public function render()
    {
        return view('livewire.credential.create-credential')
            ->title('Create Credential');
    }
}
