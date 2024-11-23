@extends('auth.layout.master')


@section('title')
    Reset Password
@endsection

@section('content')
    <div class="card" style="width: 350px;">
        <div class="card-body login-card-body">
            <p class="login-box-msg text-bold">Reset password</p>
            @error('error')
                <p class=" text text-danger text-center">{{ $message }}</p>
            @enderror

            <form method="POST" action="{{ route('resetPassword') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" value="{{ old('password') }}" autofocus placeholder="New Password" required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            {{-- <span class="fas fa-envelope"></span> --}}
                        </div>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                {{-- Confirm Password --}}
                <div class="input-group mb-3">
                    <input id="confirm_password" type="password"
                        class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
                        value="{{ old('confirm_password') }}" autofocus placeholder="Confirm Password" required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            {{-- <span class="fas fa-envelope"></span> --}}
                        </div>
                    </div>

                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reset</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
