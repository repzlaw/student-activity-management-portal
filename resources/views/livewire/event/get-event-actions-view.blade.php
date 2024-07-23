 <div class="flex flex-row justfy-end right-2">
    <a href="{{route("event.details",["event"=>$row->id])}}" class="text-gray-500 hover:text-emerald-900" title="View details"><x-eye-icon /></a>
    @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'event:update'))
        <a href="{{route("event.edit",["event"=>$row->id])}}" class="ml-4 text-gray-500 hover:text-rewe-blue" title="Edit event"><x-edit-icon /></a>
    @endif
</div>
