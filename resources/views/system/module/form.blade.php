@extends('system.layouts.form')


@section('form')
    <x-system.input :input="[
        'name' => 'name',
        'required' => true,
        'label' => 'Name',
        'value' => $item->name ?? old('name'),
    ]" />

    <x-system.input :input="[
        'name' => 'route',
        'required' => true,
        'label' => 'Route',
        'value' => $item->route ?? old('route'),
    ]" />

    <x-system.radio :input="[
        'name' => 'status',
        'label' => 'Status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />



    <div class="form-group row">
        <label for="" class="col-sm-2">Permissions</label>
        <div class="col-sm-10">

            @foreach (permissions() as $key => $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $key }}"
                        id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $permission }}
                    </label>
                </div>
            @endforeach

        </div>
    </div>
@endsection
