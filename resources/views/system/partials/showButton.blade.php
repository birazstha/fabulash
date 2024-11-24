{{-- @if (checkPermission($indexUrl . '.show')) --}}
<a href="{{ url($indexUrl , $item->id) }}" class="btn btn-primary btn-sm mr-1"> <i class="fas fa-eye"></i>
</a>
{{-- @endif --}}
