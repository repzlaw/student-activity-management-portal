 <div class="flex flex-row justfy-end right-2">
    <a href="{{route("task.details",["task"=>$row->id])}}" class="text-gray-500 hover:text-emerald-900" title="View details"><x-eye-icon /></a>
    @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'task:update'))
        <a href="{{route("task.edit",["task"=>$row->id])}}" class="ml-4 text-gray-500 hover:text-rewe-blue" title="Edit task"><x-edit-icon /></a>
    @endif
</div>
