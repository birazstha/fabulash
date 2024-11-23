@extends('auth.layout.master')

@section('title')
    Set Password
@endsection

@section('content')
    <div class="card" style="width: 350px">
        <div class="card-body login-card-body">
            @error('error')
                <p class=" text text-danger text-center">{{ $message }}</p>
            @enderror
            <form method="POST" action="{{ route('login.setPassword') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $userId ?? '' }}">

                {{-- Password --}}
                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" placeholder="Password" required autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <input id="confirm_password" type="password"
                        class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
                        placeholder="Confirm Password" required>

                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Change Password</button>
                    </div>
                </div>

            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
