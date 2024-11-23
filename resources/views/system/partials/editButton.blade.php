{{-- @if (!$isSubmodule)
    <a href="{{ route($indexUrl . '.edit', $item->id) }}" class="btn btn-success btn-sm mr-1">
        <i class="fas fa-pen"></i>
    </a>
@else
    <a href="{{ url('system/' . $parentModule . '/' . $moduleId . '/' . $indexUrl . '/' . $item->id . '/edit') }}"
        class="btn btn-success btn-sm mr-1"> <i class="fas fa-pen"></i>
    </a>
@endif --}}


<a href="{{ url($indexUrl . '/' . $item->id . '/edit') }}" class="btn btn-success btn-sm mr-1"> <i class="fas fa-pen"></i>
</a>
