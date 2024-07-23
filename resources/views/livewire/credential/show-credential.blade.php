<div>
    <div class="grid grid-cols-1 gap-6 mx-auto max-w-7xl sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2">
        <div class="space-y-6 lg:col-span-2 lg:col-start-1">
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Credential Information</h2>
                            <p class="max-w-2xl mt-1 text-sm text-gray-500">All details for this credential.</p>
                        </div>
                        <div class="flex flex-col gap-2 mt-4 sm:flex-row sm:ml-16">
                            @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update'))
                                @if ($credential->status != 'Approved')
                                    <button wire:click="confirmCredentialApproval({{$credential->id}})" type="button"
                                        class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-green-600 border-2 border-green-600 rounded-md shadow-sm hover:bg-white hover:border-2 hover:border-green-900 hover:text-green-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                        Approve
                                    </button>
                                @endif

                                @if ($credential->status != 'Rejected')
                                    <button wire:click="confirmCredentialRejection({{$credential->id}})" type="button"
                                        class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-red-600 border-2 border-red-600 rounded-md shadow-sm hover:bg-white hover:border-2 hover:border-red-900 hover:text-red-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        Reject
                                    </button>
                                @endif
                            @endif
                            
                            <button wire:click="edit" type="button"
                                class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out bg-blue-600 border-2 border-blue-600 rounded-md shadow-sm hover:bg-white hover:border-2 hover:border-blue-900 hover:text-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                Edit
                            </button>
                        
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
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->type}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Issuer</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->issuer}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($credential->status == 'Submitted')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">Submitted</span>
                                    @elseif ($credential->status == 'Approved')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">Approved</span>
                                    @elseif ($credential->status == 'Rejected')
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 rounded-md bg-pink-50 ring-1 ring-inset ring-pink-700/10">Rejected</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$credential->issue_date->format('Y-m-d')}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Expiry Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$credential->expire_date->format('Y-m-d')}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created By</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->user->name}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->created_at}}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$credential->description ?? 'No description.'}}</dd>
                            </div>
                            
                        </dl>
                    </div>
                </div>
            </section>

            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Approval Information</h2>
                        </div>
                    </div>
                    <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Approver name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->approver->name  ?? 'Not approved.'}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Approved date</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{$credential->approve_date}}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Approver's comment</dt>
                                <dd class="mt-1 text-sm text-gray-900 break-words whitespace-normal">{{$credential->approver_comment ?? 'No comment.'}}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </section>

            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Credential Attachments</h2>
                        </div>
                    </div>
                    <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                        
                            @if(count($credential->attachments) > 0)
                                <div class="sm:col-span-2">
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                            @foreach ($credential->attachments as $key => $attachment)
                                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                                    <div class="flex items-center flex-1 w-0">
                                                        <img src="{{ $attachment->url}}" width="50px" height="50px">
                                                        <span class="flex-1 w-0 ml-2 truncate">attachment {{$key + 1}} </span>
                                                        <span class="flex-1 w-0 ml-2 truncate"> 
                                                            @if ($attachment->status == 'Submitted')
                                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">Submitted</span>
                                                            @elseif ($attachment->status == 'Approved')
                                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-inset ring-green-700/10">Approved</span>
                                                            @elseif ($attachment->status == 'Rejected')
                                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 rounded-md bg-pink-50 ring-1 ring-inset ring-pink-700/10">Rejected</span>
                                                            @endif
                                                        </span>

                                                        <span class="flex-1 w-0 ml-2 truncate"> {{$attachment->approver_comment}} </span>
                                                        
                                                    </div>
                                                    <div class="flex-shrink-0 ml-4">
                                                        <div class="flex flex-row justfy-end right-2">
                                                            <a href="{{ $attachment->url }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-500" title="View attachment" ><x-eye-icon /></a>
                                                            @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'team:update'))
                                                                @if ($attachment->status != 'Approved')
                                                                <a wire:click="confirmCredentialAttachmentApproval({{$attachment->id}})" href="javascript:void(0)" class="ml-3 font-medium text-green-600 hover:text-green-500" title="Approve attachment" ><x-approve-icon /></a>
                                                                @endif
                                                                @if ($attachment->status != 'Rejected')
                                                                <a wire:click="confirmCredentialAttachmentRejection({{$attachment->id}})" href="javascript:void(0)" class="ml-3 font-medium text-red-600 hover:text-red-500" title="Reject attachment" ><x-reject-icon /></a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized',()=>{

        @this.on('confirm-approval',(event)=>{
            const data = event[0]
            Swal.fire({
                title: `${data['button_text']} ${data['model_type']}`,
                input: "textarea",
                inputPlaceholder: "Type your comment here...",
                inputAttributes: {
                    "aria-label": "Type your comment here"
                },
                showCancelButton: true,
                confirmButtonText: `${data['button_text']}`,
                showLoaderOnConfirm: true,
                preConfirm: async (comment) => {
                    // if (comment) {
                        try {
                            const response = await fetch('/approval', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token if needed
                                },
                                body: JSON.stringify({
                                    comment: comment,
                                    id: data['credential_id'],
                                    model_type: data['model_type'],
                                    action_type: data['action_type'],
                                })
                            });
                            return response.json();
                        } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                        }
                    // } else {
                    //     Swal.showValidationMessage('Approval comment required')   
                    // }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `${data['action_type']}!`,
                        text: `This ${data['model_type']} has been ${data['action_type']}.`,
                        icon: "success"
                    }).then(() => {
                        @this.dispatch('credential-approval');
                    });
                }
            });
        })

        @this.on('short-link-archive-success',(event)=>{
            const data = event
            Swal.fire({
                title: "Archived!",
                text: "Your credential has been archived.",
                icon: "success"
            });
        })

        @this.on('short-link-archive-error',(event)=>{
            const data = event
            swal.fire({
                icon  : data[0]['icon'],
                title : data[0]['title'],
                text  : data[0]['text'],
            })
        })

    })
</script>
