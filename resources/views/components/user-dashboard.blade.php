<div class="p-5">
    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Activity Hours For The Year</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$activityCount}}</dd>
      </div>
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Required Tasks</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$taskCount}}</dd>
      </div>
      <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Events</dt>
        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{$eventCount}}</dd>
      </div>
    </dl>
    
    <div class="p-5 my-10 bg-white shadow">
        <h3 class="text-base font-semibold leading-6 text-gray-900 ">Events Calendar</h3>
        <livewire:events-calendar
            before-calendar-view="livewire/dashboard/before-calendar-view"
            :day-click-enabled="false"
            :drag-and-drop-enabled="false"
        />
    </div>

    <div class="p-5 my-10 bg-white shadow">
      <h3 class="mb-5 text-base font-semibold leading-6 text-gray-900">Required Tasks</h3>
      <livewire:dashboard.dashboard-task-table/>
  </div>
</div>
