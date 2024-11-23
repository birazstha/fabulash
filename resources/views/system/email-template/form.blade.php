@extends('system.layouts.form')

@section('form')

    {{-- Code --}}
    <x-system.input :input="[
        'name' => 'code',
        'value' => $item->code ?? old('code'),
        'autofocus' => true,
    ]" />

    {{-- Subject --}}
    <x-system.input :input="[
        'name' => 'subject',
        'required' => true,
        'value' => $item->subject ?? old('subject'),
        'autofocus' => true,
    ]" />

    {{-- Content --}}
    <x-system.textarea :input="[
        'name' => 'content',
        'class' => 'ckeditor',
        'label' => 'Email',
        'value' => $item->content ?? old('content'),
    ]" />

    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'label' => 'Status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />
@endsection
