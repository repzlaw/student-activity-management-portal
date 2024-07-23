<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Event;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Omnia\LivewireCalendar\LivewireCalendar;

class EventsCalendar extends LivewireCalendar
{
    public function events() : Collection
    {
        return Event::query()
            ->whereDate('start_date', '>=', $this->gridStartsAt)
            ->whereDate('end_date', '<=', $this->gridEndsAt)
            ->where('team_id', Auth::user()->currentTeam->id)
            ->get()
            ->flatMap(function (Event $model) {
                // Generate a collection of dates from start_date to end_date
                $period = new CarbonPeriod($model->start_date, $model->end_date);

                return collect($period)->map(function (Carbon $date) use ($model) {
                    return [
                        'id' => $model->id,
                        'title' => $model->name,
                        'description' => $model->description,
                        'date' => $date->toDateString(),
                    ];
                });
            });
    }

    public function onEventClick($eventId)
    {
        $this->redirect("/event/$eventId/details");
    }

}
