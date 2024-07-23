<div>
    <div class="grid grid-cols-1 gap-6 mx-auto max-w-7xl sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2">
        <div class="space-y-6 lg:col-span-2 lg:col-start-1">
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Event Information</h2>
                            <p class="max-w-2xl mt-1 text-sm text-gray-500">All details for this event.</p>
                        </div>
                        <div class="flex flex-col gap-2 mt-4 sm:flex-row sm:ml-16">
                            @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'event:update'))
                                <button wire:click="edit" type="button"
                                    class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-blue-600 border-2 border-blue-600 rounded-md shadow-sm hover:bg-white hover:border-2 hover:border-blue-900 hover:text-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    Edit
                                </button>
                            @endif
                        
                            <button wire:click="back" type="button"
                                class="flex-shrink-0 block w-auto px-3 py-2 mt-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-gray-600 border-2 border-gray-600 rounded-md shadow-sm sm:ml-2 sm:mt-0 hover:bg-white hover:border-2 hover:border-gray-900 hover:text-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                Back
                            </button>
                        </div>
                    </div>
                    <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$event->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$event->type}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$event->start_date->format('Y-m-d')}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">End Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$event->end_date->format('Y-m-d')}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created By</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$event->user->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$event->created_at}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$event->location}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$event->description ?? 'No description.'}}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

