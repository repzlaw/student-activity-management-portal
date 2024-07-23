 <div class="flex flex-row justfy-end right-2">
    <a href="{{route("activity.details",["activity"=>$row->id])}}" class="text-gray-500 hover:text-emerald-900" title="View details"><x-eye-icon /></a>
    <a href="{{route("activity.edit",["activity"=>$row->id])}}" class="ml-4 text-gray-500 hover:text-rewe-blue" title="Edit activity"><x-edit-icon /></a>
</div>
