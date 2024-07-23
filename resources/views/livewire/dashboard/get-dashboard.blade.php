<div class="py-12">
    <div class="mx-auto max-w-1xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update'))
                <x-admin-dashboard 
                    :registeredUsersCount="$registeredUsersCount"
                    :eventCount="$eventCount"
                    :activeUsers="$activeUsers">
                </x-admin-dashboard>
            @else
                <x-user-dashboard 
                    :activityCount="$activityCount"
                    :eventCount="$eventCount"
                    :taskCount="$taskCount">
                </x-user-dashboard>
            @endif
        </div>
    </div>
</div>