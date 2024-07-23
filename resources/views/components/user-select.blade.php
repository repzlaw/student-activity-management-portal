<div>
    <div wire:ignore>
        <select id="assigned_to" data-placeholder="{{ __('Select User')}}" required
            name="assigned_to" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6">
            <option value="">Select User</option>
            @foreach ($options as $option)
                <option value="{{ $option->id }}" {{ ($option->id == $user) ? 'selected' : '' }}>{{$option->name}}</option>
            @endforeach
        </select>
    </div>
</div>

@assets
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets

@script
<script>
    $(document).ready(function() {
        $('#assigned_to').select2({
        });

        $('#assigned_to').on('change', function () {
            let data = $(this).val()
            $wire.form.assigned_to = data
        });

    });
</script>
@endscript