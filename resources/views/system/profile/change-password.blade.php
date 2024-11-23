@extends('system.layouts.show')

@section('title')
    <h3> <b>Change Password</b></h3>
@endsection
@section('content-first')
    <form action="{{ route('update-password') }}" method="POST">
        @csrf

        {{-- Current Password --}}
        <x-system.input :input="[
            'name' => 'current_password',
            'type' => 'password',
            'value' => $item->current_password ?? old('current_password'),
            'autofocus' => true,
        ]" />

        {{-- Password --}}
        <x-system.input :input="[
            'name' => 'password',
            'type' => 'password',
            'message' => 'Password must contain at least one uppercase letter, one lowercase
                            letter, one number, and one special character.',
            'value' => $item->password ?? old('password'),
        ]" />

        {{-- Change Password --}}
        <x-system.input :input="[
            'name' => 'confirm_password',
            'type' => 'password',
            'value' => $item->confirm_password ?? old('confirm_password'),
        ]" />

        <div class="form-group row">
            <label for="" class="col-sm-2"></label>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-sm action-btn" id="btnAdd"><i class="fas fa-recycle"></i>&nbsp
                    Update</button>
            </div>
        </div>
    </form>
@endsection
