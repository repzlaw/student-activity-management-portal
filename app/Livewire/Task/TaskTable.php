<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class TaskTable extends PowerGridComponent
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
        $tasks = Task::query()->where('team_id', Auth::user()->currentTeam->id);
        
        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update')) {
            $tasks = $tasks->where('assigned_to', Auth::id());
        }
        
        return $tasks;
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
            ->add('description_excerpt', function (Task $model) {
                return Str::limit(e($model->description), 15); 
            })
            ->add('due_date_formatted', fn (Task $model) => Carbon::parse($model->due_date)->format('d/m/Y H:i:s'))
            ->add('complete_date_formatted', fn (Task $model) => Carbon::parse($model->complete_date)->format('d/m/Y H:i:s'))
            ->add('assign_to', function (Task $model) {
                return ($model->assigned->name ?? null); 
            })
            ->add('status_formatted', function (Task $model) {
                if ($model->status == 'TO DO') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">TO DO</span>';
                } else if ($model->status == 'IN PROGRESS') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 rounded-md bg-yellow-50 ring-1 ring-inset ring-yellow-700/10">IN PROGRESS</span>';
                } else if ($model->status == 'COMPLETED') {
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">COMPLETED</span>';
                }
            })
            ->add('user_name', function (Task $model) {
                return ($model->user->name); 
            })
            ->add('created_at');
    }

    public function columns(): array
    {
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

            Column::make('Due date', 'due_date_formatted', 'due_date')
                ->sortable(),

            Column::make('Completed date', 'complete_date_formatted', 'complete_date')
                ->sortable(),

            Column::make('Assigned to', 'assign_to', 'assigned_to'),
                
            Column::make('Status', 'status_formatted', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Created by', 'user_name', 'user_id')
                ->hidden(isHidden: true, isForceHidden: false),
                
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
            Filter::datetimepicker('due_date'),
            Filter::datetimepicker('complete_date'),
        ];
    }

    public function actionsFromView($row): View
    {
        return view('livewire.task.get-task-actions-view', ['row' => $row]);
    }
}
