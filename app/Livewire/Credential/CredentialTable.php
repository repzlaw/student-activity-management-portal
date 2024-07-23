<?php

namespace App\Livewire\Credential;

use Illuminate\View\View;
use App\Models\Credential;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CredentialTable extends PowerGridComponent
{
    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public int $perPage = 10;

    public array $perPageValues = [10, 20, 30];

    public function setUp(): array
    {
        return [
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $credentials = Credential::query()->where('team_id', Auth::user()->currentTeam->id);
        
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update')) {
            $credentials = $credentials->where('user_id', Auth::id());
        }
        
        return $credentials;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name')
            ->add('type')
            ->add('description_excerpt', function (Credential $model) {
                return Str::limit(e($model->description), 15); 
            })
            ->add('issuer')
            ->add('status_formatted', function (Credential $model) {
                if ($model->status == 'Submitted') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">Submitted</span>';
                } else if ($model->status == 'Approved') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">Approved</span>';
                } else if ($model->status == 'Rejected') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 rounded-md bg-pink-50 ring-1 ring-inset ring-pink-700/10">Rejected</span>';
                }
            })
            ->add('issue_date_formatted', fn (Credential $model) => Carbon::parse($model->issue_date)->format('d/m/Y'))
            ->add('expire_date_formatted', fn (Credential $model) => Carbon::parse($model->expire_date)->format('d/m/Y'))
            ->add('approver_name', function (Credential $model) {
                return ($model->approver->name ?? null); 
            })
            ->add('approver_comment')
            ->add('approve_date_formatted', fn (Credential $model) => Carbon::parse($model->approve_date)->format('d/m/Y'))
            ->add('user_name', function (Credential $model) {
                return ($model->user->name); 
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        $user = Auth::user();
        $canUpdateTeam = $user->hasTeamPermission($user->currentTeam, 'team:update');
        
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description_excerpt', 'long_url')
                ->sortable()
                ->searchable(),

            Column::make('Issuer', 'issuer')
                ->sortable()
                ->searchable(),

            Column::make('Issue date', 'issue_date_formatted', 'issue_date')
                ->sortable(),

            Column::make('Expire date', 'expire_date_formatted', 'expire_date')
                ->sortable(),

            Column::make('Status', 'status_formatted', 'status')
                ->sortable()
                ->searchable(),
                
            Column::make('Approver', 'approver_name', 'approver_id')
                ->hidden(isHidden: true, isForceHidden: false),

            Column::make('Approvers comment', 'approver_comment')
                ->sortable()
                ->searchable()
                ->hidden(isHidden: true, isForceHidden: false),

            Column::make('Approved date', 'approve_date_formatted', 'approve_date')
                ->sortable()
                ->hidden(isHidden: true, isForceHidden: false),

            Column::make('Created by', 'user_name', 'user_id')
                ->hidden(isHidden: !$canUpdateTeam, isForceHidden: false),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->hidden(isHidden: true, isForceHidden: false),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('issue_date'),
            Filter::datetimepicker('expire_date'),
            Filter::datetimepicker('approve_date'),
        ];
    }

    public function actionsFromView($row): View
    {
        return view('livewire.credential.get-credential-actions-view', ['row' => $row]);
    }

}
