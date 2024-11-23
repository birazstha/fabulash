@extends('system.layouts.form')

@section('form')
    <x-system.input :input="[
        'name' => 'name',
        'required' => true,
        'label' => 'Name',
        'value' => $item->name ?? old('name'),
    ]" />

    <div class="form-group row">
        <label for="" class="col-sm-2">Permissions</label>
        <div class="col-sm-10">
            @foreach ($modules as $key => $module)
                <h4>
                    <input type="checkbox" id="{{ 'parent_' . $key + 1 }}" onchange="checkChildren('{{ $key + 1 }}')">
                    {{ $module->name }}
                </h4>
                <div class="d-flex flex-wrap mb-3 border-bottom border-muted">
                    @foreach ($module->permissions as $permission)
                        <span class="form-check mr-3 mb-3">
                            <input class="form-check-input child_{{ $permission->module_id }}" name="permission_id[]"
                                type="checkbox" value="{{ $permission->id }}" id="permission_{{ $permission->id }}"
                                {{ isset($permissions) && in_array($permission->id, $permissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        function checkChildren(parentId) {
            var parentCheckbox = document.getElementById('parent_' + parentId);
            var childCheckboxes = document.querySelectorAll('.child_' + parentId);

            childCheckboxes.forEach(function(checkbox) {
                checkbox.checked = parentCheckbox.checked;
            });
        }
    </script>
@endsection
