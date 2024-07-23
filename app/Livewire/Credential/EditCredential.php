<?php

namespace App\Livewire\Credential;

use Livewire\Component;
use App\Models\Credential;
use Livewire\WithFileUploads;
use App\Models\CredentialAttachment;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\CredentialForm;
use Illuminate\Support\Facades\Storage;

class EditCredential extends Component
{
    use WithFileUploads;
    
    public CredentialForm $form;

    public $credential;

    public $form_type = 'update';

    public function mount(Credential $credential) 
    {
        if ($credential->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $credential->user_id != Auth::id()) {
            abort(403);
        }

        $this->form->setCredential($credential);

        $this->credential = $credential;
    }
    
    public function saveCredential()
    {
        $this->validate();

        $credential_id = $this->form->credential->id;

        $this->form->credential->update([
            'name'        => $this->form->name,
            'type'        => $this->form->type,
            'description' => $this->form->description,
            'status'      => 'Submitted',
            'issuer'    => $this->form->issuer,
            'issue_date'  => $this->form->issue_date,
            'expire_date'    => $this->form->expire_date,
        ]);

        if(count($this->form->attachments)) {
            if(!isset($this->form->attachments[0]->id)){

                // Iterate through each attachment and delete it
                foreach ($this->credential->attachments as $attachment) {
                    // Delete the file from the storage
                    Storage::delete($attachment->filename);
                    // Delete the attachment record
                    $attachment->delete();
                }

                foreach ($this->form->attachments as $attachment) {
                    $attachment->store(path: 'credential');
                    $size = $attachment->getSize();
                    $path = $attachment->store('credential', 'public');
                    $url = Storage::url($path);
                    $fileType = $attachment->getMimeType();
        
                    CredentialAttachment::create([
                        'filename'      => $path,
                        'status'        => 'Submitted',
                        'size'          => $size,
                        'url'           => $url,
                        'type'          => $fileType,
                        'credential_id' => $credential_id,
                    ]);
                }
            }

        }

        $this->form->reset();
        $this->redirect("/credential/$credential_id/details");

    }

    function back() 
    {
        $this->redirect('/credential'); 
    }

    public function render()
    {
        return view('livewire.credential.create-credential')
            ->title('Update Credential');
    }
}
