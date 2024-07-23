<?php

namespace App\Livewire\Activity;

use App\Models\Activity;
use Illuminate\View\View;
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

final class ActivityTable extends PowerGridComponent
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
        $activities = Activity::query()->where('team_id', Auth::user()->currentTeam->id);
        
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update')) {
            $activities = $activities->where('user_id', Auth::id());
        }
        
        return $activities;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('type')
            ->add('description_excerpt', function (Activity $model) {
                return Str::limit(e($model->description), 15); 
            })
            ->add('provider_excerpt', function (Activity $model) {
                return Str::limit(e($model->provider), 30); 
            })
            ->add('start_date_formatted', fn (Activity $model) => Carbon::parse($model->start_date)->format('d/m/Y'))
            ->add('end_date_formatted', fn (Activity $model) => Carbon::parse($model->end_date)->format('d/m/Y'))
            ->add('hours')
            ->add('status_formatted', function (Activity $model) {
                if ($model->status == 'Submitted') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">Submitted</span>';
                } else if ($model->status == 'Approved') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">Approved</span>';
                } else if ($model->status == 'Rejected') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 rounded-md bg-pink-50 ring-1 ring-inset ring-pink-700/10">Rejected</span>';
                }
            })
            ->add('approver_name', function (Activity $model) {
                return ($model->approver->name ?? null); 
            })
            ->add('approver_comment')
            ->add('approve_date_formatted', fn (Activity $model) => Carbon::parse($model->approve_date)->format('d/m/Y'))
            ->add('user_name', function (Activity $model) {
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

            Column::make('Provider', 'provider_excerpt', 'provider')
                ->sortable()
                ->searchable(),

            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),

            Column::make('Hours', 'hours')
                ->sortable()
                ->searchable(),

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
            Filter::datetimepicker('start_date'),
            Filter::datetimepicker('end_date'),
            Filter::datetimepicker('approve_date'),
        ];
    }

    public function actionsFromView($row): View
    {
        return view('livewire.activity.get-activity-actions-view', ['row' => $row]);
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    // public function actions(Activity $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: '.$row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
