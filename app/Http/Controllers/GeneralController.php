<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Credential;
use Illuminate\Http\Request;
use App\Models\ActivityAttachment;
use App\Models\CredentialAttachment;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    // approve/reject models
    public function approval(Request $request) : bool 
    {
        // Define the model mapping
        $modelMapping = [
            'activity' => Activity::class,
            'activity attachment' => ActivityAttachment::class,
            'credential' => Credential::class,
            'credential attachment' => CredentialAttachment::class,
        ];

        // Check if the model type exists in the mapping
        if (!array_key_exists($request->model_type, $modelMapping)) {
            abort(403, 'Invalid model type');
        }

        // Get the model class
        $modelClass = $modelMapping[$request->model_type];

        // Find the model instance
        $model = $modelClass::findOrFail($request->id);      

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update') && $model->user_id != Auth::id()) {
            abort(403);
        }

        $model->update([
            'status' => $request->action_type,
            'approve_date' => now(),
            'approver_comment' => $request->comment,
            'approver_id' => Auth::id(),
        ]);

        return true;
    }
}
