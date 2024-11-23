@extends('auth.layout.master')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="card" style="width: 350px">
        <div class="card-body login-card-body">
            <p class="login-box-msg text-bold">Reset password</p>
            @error('error')
                <p class=" text text-danger text-center">{{ $message }}</p>
            @enderror

            <form method="POST" action="{{ route('forgotPassword') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" autofocus placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <p>Have an account? Click <a href="{{ route('login') }}" style="text-decoration: none">here</a>.</p>

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
