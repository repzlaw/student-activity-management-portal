<div>
    <div class="mx-auto max-w-screen-1xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Credentials</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all credentials in your current group including their name, title, description and provider.</p>
                    </div>
                    @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'credential:create'))
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex">
                            <button wire:click="createCredentialPage" type="button" class="block px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out border-2 rounded-md shadow-sm sm:flex bg-kano-blue border-kano-blue hover:bg-white hover:border-2 hover:border-kano-blue hover:text-kano-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Create Credential
                            </button>
                        </div>
                    @endif
                </div>
                <hr class="mt-4">
                <div class="flow-root mt-8">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                @if (!$credentialExists)
                                 <div class="mb-3 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                    <div class="p-4 rounded-md bg-blue-50">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 ml-3 md:flex md:justify-between">
                                                <p class="text-sm text-blue-700">No Credentials Created.</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <livewire:credential.credential-table />
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
    <link rel="stylesheet" href="https://unpkg.com/slim-select@latest/dist/slimselect.css" />
@endassets

<script>
    document.addEventListener('livewire:initialized',()=>{

        @this.on('confirm-short-link-archive',(event)=>{
            const data = event[0]
            Swal.fire({
                title: "Are you sure?",
                text: "This credential will be unavailable for use and all details would be lost!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#333",
                confirmButtonText: "Yes, archive it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('archive-credentials', {
                        credential: data['credential_id']
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
