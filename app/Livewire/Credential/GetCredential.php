<?php

namespace App\Livewire\Credential;

use Livewire\Component;
use App\Models\Credential;
use Illuminate\Support\Facades\Auth;

class GetCredential extends Component
{
    public function createCredentialPage()
    {
        $this->redirect('/credential/create');
    }

    public function render()
    {
        $user   = Auth::user();
        $teamId = $user->currentTeam->id;

        $credentialExists = Credential::where('team_id', $teamId)
            ->when(!$user->hasTeamPermission($user->currentTeam, 'team:update'), function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->exists();

        return view('livewire.credential.get-credential', [
            'credentialExists' => $credentialExists,
        ])
        ->title('Credentials');
    }
    
}
