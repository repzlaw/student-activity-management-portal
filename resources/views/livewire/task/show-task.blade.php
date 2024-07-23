<div>
    <div class="grid grid-cols-1 gap-6 mx-auto max-w-7xl sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2">
        <div class="space-y-6 lg:col-span-2 lg:col-start-1">
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Task Information</h2>
                            <p class="max-w-2xl mt-1 text-sm text-gray-500">All details for this task.</p>
                        </div>
                        <div class="flex flex-col gap-2 mt-4 sm:flex-row sm:ml-16">
                            @if($task->modelable_type)
                                <button wire:click="goToTask()" type="button"
                                    class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-teal-600 border-2 border-teal-600 rounded-md shadow-sm hover:bg-white hover:border-2 hover:border-teal-900 hover:text-teal-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                                    Go to Task
                                </button>
                            @endif
                            
                            <button wire:click="setStatusForm({{$task->id}})" type="button"
                                class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out border-2 rounded-md shadow-sm bg-sky-600 border-sky-600 hover:bg-white hover:border-2 hover:border-sky-900 hover:text-sky-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                                Set Status
                            </button>
                            
                            @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'task:update'))
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
                                <dd class="mt-1 text-sm text-gray-900">{{$task->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$task->type}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$task->due_date->format('Y-m-d H:i')}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Completed Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$task->complete_date ? $task->complete_date->format('Y-m-d H:i') : 'Not completed.'}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Assigned to</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$task->assigned->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created By</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$task->user->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$task->created_at}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($task->status == 'TO DO')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">{{$task->status}}</span>
                                    @elseif ($task->status == 'IN PROGRESS')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 rounded-md bg-yellow-50 ring-1 ring-inset ring-yellow-700/10">{{$task->status}}</span>
                                    @elseif ($task->status == 'COMPLETED')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">{{$task->status}}</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$task->description ?? 'No description.'}}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized',()=>{

        @this.on('confirm-set-status',(event)=>{
            const data = event[0]
            Swal.fire({
                title: "Set Status",
                input: "select",
                inputOptions: {
                    "COMPLETED": "COMPLETED",
                    "IN PROGRESS": "IN PROGRESS",
                    "TO DO": "TO DO",
                },
                inputPlaceholder: "Select Status",
                showCancelButton: true,
                confirmButtonText: "Set",
                showLoaderOnConfirm: true,
                preConfirm: async (status) => {
                    if (status) {
                        try {
                            @this.dispatch('set-status', { 
                                status: status, 
                            });
                        } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                        }

                        // try {
                        //     const response = await fetch('task/set-status', {
                        //         method: 'POST',
                        //         headers: {
                        //             'Content-Type': 'application/json',
                        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token if needed
                        //         },
                        //         body: JSON.stringify({
                        //             status: status,
                        //             id: data['task_id'],
                        //         })
                        //     });
                        //     return response.json();
                        // } catch (error) {
                        //     Swal.showValidationMessage(`
                        //         Request failed: ${error}
                        //     `);
                        // }
                    } else {
                        Swal.showValidationMessage('Task status required')   
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `Success!`,
                        text: `Task status has been set.`,
                        icon: "success"
                    }).then(() => {
                        @this.dispatch('status-set');
                    });
                }
            });
        })

    })
</script>