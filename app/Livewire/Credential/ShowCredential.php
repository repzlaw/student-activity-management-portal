<?php

namespace App\Livewire\Credential;

use Livewire\Component;
use App\Models\Credential;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ShowCredential extends Component
{
    public $credential;

    #[On('credential-approval')] 
    public function reloadComponent()
    {
        $this->render();
    }

    public function mount(Credential $credential) 
    {
        if ($credential->team_id !== Auth::user()->currentTeam->id) {
            abort(403);
        }

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $credential->user_id != Auth::id()) {
            abort(403);
        }

        $this->credential   = $credential;
    }

    function edit() 
    {
        $credential_id = $this->credential->id;
        $this->redirect("/credential/$credential_id/edit"); 
    }

    public function confirmCredentialApproval($credential_id, $action_type='Approved')
    {
        $this->dispatch('confirm-approval', [
            'credential_id'=> $credential_id,
            'action_type'=> $action_type,
            'model_type'=> 'credential',
            'button_text'=> 'Approve',
        ]);
    }

    public function confirmCredentialRejection($credential_id, $action_type='Rejected')
    {
        $this->dispatch('confirm-approval', [
            'credential_id'=> $credential_id,
            'action_type'=> $action_type,
            'model_type'=> 'credential',
            'button_text'=> 'Reject',
        ]);
    }

    public function confirmCredentialAttachmentApproval($credential_id, $action_type='Approved')
    {
        $this->dispatch('confirm-approval', [
            'credential_id'=> $credential_id,
            'action_type'=> $action_type,
            'model_type'=> 'credential attachment',
            'button_text'=> 'Approve',
        ]);
    }

    public function confirmCredentialAttachmentRejection($credential_id, $action_type='Rejected')
    {
        $this->dispatch('confirm-approval', [
            'credential_id'=> $credential_id,
            'action_type'=> $action_type,
            'model_type'=> 'credential attachment',
            'button_text'=> 'Reject',
        ]);
    }

    function back() 
    {
        $this->redirect('/credential'); 
    }

    public function render()
    {
        return view('livewire.credential.show-credential')
            ->title('Credential details');
    }
}
