@if (checkPermission($indexUrl . '/create', 'GET'))
    <a href="{{ url($indexUrl . '/create') }}" class="btn btn-success btn-sm mr-1"><i class="fa fa-plus"></i> Add</a>
@endif
