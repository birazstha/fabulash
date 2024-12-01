@extends('system.layouts.show')

@section('title')
    <h3> {{ $$moduleName ?? '' }} Details</h3>
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

    {{-- Country --}}
    <x-system.detail :input="[
        'label' => 'Country',
        'value' => $item->country->name ?? 'N/A',
    ]" />

    {{-- Area of Interest --}}


    @if ($item->subject->title != 'Others')
        <x-system.detail :input="[
            'label' => 'Area Of Interest',
            'value' => $item->subject->title ?? 'N/A',
        ]" />
    @else
        <x-system.detail :input="[
            'label' => 'Area Of Interest',
            'value' => $item->other_area_of_interest ?? 'N/A',
        ]" />
    @endif

    {{-- Date --}}
    <x-system.detail :input="[
        'label' => 'Received At',
        'value' => convertToTime($item->created_at) ?? 'N/A',
    ]" />
@endsection

@section('content-second')
    <hr>
    <h3 class="border-bottom">Message</h3>
    <i> {!! $item->message !!}</i>
@endsection
