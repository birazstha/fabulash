@extends('system.layouts.show')

@section('title')
    <h3> <b>My Profile</b></h3>
@endsection

@section('back')
    <div class="card-tools">

        @if (checkPermission($indexUrl . '/change-password', 'GET'))
            <a href="{{ route('update-password-form') }}" class="btn btn-success btn-sm m-1">Change Password</a>
        @endif

        @if (checkPermission($indexUrl . '/update-profile-form', 'GET'))
            <a href="{{ route('update-profile-form') }}" class="btn btn-info btn-sm mr-1">Update Profile</a>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i>
            Back</a>
    </div>
@endsection


@section('content-first-left')
    {{-- Name --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'value' => $item->name ?? 'N/A',
    ]" />

    {{-- Username --}}
    <x-system.detail :input="[
        'label' => 'Username',
        'value' => $item->username ?? 'N/A',
    ]" />

    {{-- Contact Number --}}
    <x-system.detail :input="[
        'label' => 'Role',
        'value' => $item->role->name ?? 'N/A',
    ]" />
@endsection

@section('content-first-right')
    {{-- Joined At --}}
    <x-system.detail :input="[
        'label' => 'Joined At',
        'value' => $item->created_at ?? '-',
    ]" />
@endsection
