<?php

namespace App\Livewire\Event;

use App\Models\Event;
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

final class EventTable extends PowerGridComponent
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
        $events = Event::query()->where('team_id', Auth::user()->currentTeam->id);

        if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'event:update')) {
            $events = $events->where('end_date', '>=', Carbon::now());
        }
        
        return $events;
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
            ->add('description_excerpt', function (Event $model) {
                return Str::limit(e($model->description), 15); 
            })
            ->add('location')
            ->add('start_date_formatted', fn (Event $model) => Carbon::parse($model->start_date)->format('d/m/Y H:i:s'))
            ->add('end_date_formatted', fn (Event $model) => Carbon::parse($model->end_date)->format('d/m/Y H:i:s'))
            ->add('user_name', function (Event $model) {
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

            Column::make('Location', 'location')
                ->sortable()
                ->searchable(),

            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),

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
            Filter::datetimepicker('start_date'),
            Filter::datetimepicker('end_date'),
        ];
    }

    public function actionsFromView($row): View
    {
        return view('livewire.event.get-event-actions-view', ['row' => $row]);
    }

}
