@extends('system.layouts.form')

@section('form')
    {{-- Name --}}
    <x-system.input :input="[
        'name' => 'name',
        'value' => $item->name ?? old('name'),
        'required' => true,
    ]" />

    {{-- Post --}}
    <x-system.input :input="[
        'name' => 'post',
        'required' => true,
        'value' => $item->post ?? old('post'),
    ]" />

    {{-- Company --}}
    <x-system.input :input="[
        'name' => 'company',
        'value' => $item->company ?? old('company'),
    ]" />

    {{-- Words --}}
    <x-system.textarea :input="[
        'name' => 'words',
        'value' => $item->words ?? old('words'),
        'required' => true,
    ]" />

    {{-- Rank --}}
    <x-system.input :input="[
        'name' => 'rank',
        'type' => 'number',
        'required' => true,
        'value' => $item->rank ?? old('rank'),
    ]" />

    {{-- Image --}}
    <x-system.image :input="[
        'name' => 'photo',
        'required' => isset($item) ? false : true,
        'value' => $item->files ?? null,
        'folder' => $indexUrl,
    ]" />


    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />
@endsection
