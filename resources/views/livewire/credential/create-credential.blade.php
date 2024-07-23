<div>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <form class="p-5" wire:submit="saveCredential">
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-gray-900 capitalize text-transform:">{{ $form_type }} Credential</h2>
                        <p class="max-w-2xl mb-5 text-sm leading-6 text-gray-600">Fill out this form to {{ $form_type }} a credential.</p>

                        <div class="pb-12 space-y-8 border-b border-gray-900/10 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input wire:model="form.name" type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6" required>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write the name of the credential.</p>
                                    @error('form.name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Type
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <select wire:model.live="form.type" id="type" name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6" required>
                                        <option value="">Select Credential Type</option>
                                        <option value="TypeA">TypeA</option>
                                        <option value="TypeB">TypeB</option>
                                        <option value="TypeC">TypeC</option>
                                    </select>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Select the type of credential.</p>
                                    @error('form.type') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Description
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <textarea required wire:model="form.description" id="description" name="description" rows="1" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6"></textarea>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a short description of the credential.</p>
                                    @error('form.description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="issuer" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Issuer
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input wire:model="form.issuer" name="issuer" id="issuer" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6" required>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write the name of the issuer.</p>
                                    @error('form.issuer') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="issue_date" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Issue Date
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input wire:model.live="form.issue_date" type="date" name="issue_date" id="issue_date" 
                                        max="{{$form->expire_date}}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6" required>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Select issue date.</p>
                                    @error('form.issue_date') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="expire_date" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Expiry Date
                                    <span class="error">*</span>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input wire:model.live="form.expire_date" type="date" name="expire_date" id="expire_date" 
                                        min="{{$form->issue_date}}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6" required>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Select expiry date.</p>
                                    @error('form.expire_date') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                                <label for="attachments" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Attachments</label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        x-data="{ uploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = false"
                                        x-on:livewire-upload-cancel="uploading = false"
                                        x-on:livewire-upload-error="uploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    >
                                        <div class="flex justify-center max-w-2xl px-6 py-10 border border-dashed rounded-lg border-gray-900/25">
                                            <div class="text-center">
                                                <PhotoIcon class="w-12 h-12 mx-auto text-gray-300" aria-hidden="true" />
                                                <div class="flex mt-4 text-sm leading-6 text-gray-600">
                                                    <label for="attachments" class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input wire:model="form.attachments" accept="image/*" id="attachments" type="file" class="sr-only" multiple />
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-600">PNG, JPG up to 10MB</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div x-show="uploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                  <p class="mt-3 text-sm leading-6 text-gray-600">Select attachments to add.</p>
                                    @error('form.attachments.*') <span class="error">{{ $message }}</span> @enderror
                                    
                                    @if ($form->attachments)
                                        @foreach ( $form->attachments as $attachment)
                                        <div class="my-5">
                                            @if($form_type == 'create')
                                                <img src="{{ $attachment->temporaryUrl() }}" width="50%" height="50%">
                                            @else
                                                <img src="{{ $attachment->url ??  $attachment->temporaryUrl()}}" width="50%" height="50%">
                                            @endif
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-x-6">
                    <button wire:click="back" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-semibold text-gray-400 capitalize transition duration-150 ease-in-out bg-white border-2 border-gray-400 rounded-md shadow-sm text-transform: hover:border-gray-600 hover:text-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        Cancel
                    </button>

                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-semibold text-white capitalize transition duration-150 ease-in-out border-2 rounded-md shadow-sm text-transform: bg-kano-blue border-kano-blue hover:bg-white hover:text-kano-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ $form_type }}
                    </button>

                    <div class="ml-2" wire:loading>
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 ml-3 text-white me-3 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>

<script>
    document.addEventListener('livewire:initialized',()=>{

        @this.on('swal',(event)=>{
            const data = event
            swal.fire({
                icon  : data[0]['icon'],
                title : data[0]['title'],
                text  : data[0]['text'],
            })
        })

    })
</script>
