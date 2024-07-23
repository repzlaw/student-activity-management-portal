 <div class="flex flex-row justfy-end right-2">
    <a href="{{route("credential.details",["credential"=>$row->id])}}" class="text-gray-500 hover:text-emerald-900" title="View details"><x-eye-icon /></a>
    <a href="{{route("credential.edit",["credential"=>$row->id])}}" class="ml-4 text-gray-500 hover:text-rewe-blue" title="Edit credential"><x-edit-icon /></a>
</div>
