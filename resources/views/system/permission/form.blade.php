@extends('system.layouts.form')


@section('form')
    {{-- Module --}}
    <x-system.select :input="[
        'name' => 'module_id',
        'label' => 'Module',
        'required' => true,
        'options' => $modules ?? [],
        'value' => $item->module_id ?? (old('module_id') ?? request()->moduleId),
    ]" />
    {{-- Name --}}
    <x-system.input :input="[
        'name' => 'name',
        'required' => true,
        'label' => 'Name',
        'value' => $item->name ?? old('name'),
    ]" />

    {{-- Route --}}
    <x-system.input :input="[
        'name' => 'route',
        'required' => true,
        'label' => 'Route',
        'value' => $item->route ?? old('route'),
    ]" />
@endsection
