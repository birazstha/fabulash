@extends('system.layouts.show')


@section('back')
@endsection


@section('content-first-left')
    {{-- Name --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'value' => $item->name ?? 'N/A',
    ]" />

    {{-- Email --}}
    <x-system.detail :input="[
        'label' => 'Email',
        'value' => $item->email ?? 'N/A',
    ]" />

    {{-- Contact --}}
    <x-system.detail :input="[
        'label' => 'Contact',
        'value' => $item->contact ?? 'N/A',
    ]" />

    {{-- Date --}}
    <x-system.detail :input="[
        'label' => 'Received At',
        'value' => convertToTime($item->created_at) ?? 'N/A',
    ]" />
@endsection

@section('content-second')
    <hr>
    <h3 class="border-bottom">Message</h3>
    <div class="card p-4 mt-3" style="min-height: 200px">
        <i> {!! $item->message !!}</i>
    </div>
@endsection
