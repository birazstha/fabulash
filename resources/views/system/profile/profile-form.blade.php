@extends('system.layouts.show')

@section('title')
    <h3> <b>My Profile</b></h3>
@endsection
@section('content-first')
    <form action="{{ route('update-profile') }}" method="POST">
        @csrf

        <input type="hidden" name="id" value="{{ $item->id }}">
        {{-- Name --}}
        <x-system.input :input="[
            'name' => 'name',
            'required' => true,
            'value' => $item->name ?? old('name'),
            'autofocus' => true,
        ]" />

        {{-- Username --}}
        <x-system.input :input="[
            'name' => 'username',
            'required' => true,
            'value' => $item->username ?? old('username'),
        ]" />

        {{-- Email --}}
        <x-system.input :input="[
            'name' => 'email',
            'required' => true,
            'value' => $item->email ?? old('email'),
        ]" />

        <div class="form-group row">
            <label for="" class="col-sm-2"></label>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-sm action-btn" id="btnAdd"><i class="fas fa-recycle"></i>&nbsp Update</button>
            </div>
        </div>
    </form>
@endsection
