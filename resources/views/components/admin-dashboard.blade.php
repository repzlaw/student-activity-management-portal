<div class="p-5">
    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Registered Users</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$registeredUsersCount}}</dd>
      </div>
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Active Users Past 30 Days</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$activeUsers}}</dd>
      </div>
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Events</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$eventCount}}</dd>
      </div>
    </dl>
    
    <div class="p-5 my-10 bg-white shadow">
        <h3 class="mb-5 text-base font-semibold leading-6 text-gray-900">Required Tasks</h3>
        <livewire:dashboard.dashboard-task-table />
    </div>
</div>