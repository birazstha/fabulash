@extends('auth.layout.master')

@section('title')
    Login
@endsection

@section('content')
    <!-- /.login-logo -->
    <div class="card" style="width: 350px">
        <div class="card-body login-card-body">
            <p class="login-box-msg"></p>

            @if (session('success-alert'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your account has been created. Please wait until your account is verified.
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error-alert'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error-alert') }}
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            @if (session('success'))
                <p class=" text text-success text-center">{{ $message }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" autofocus placeholder="Username">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="Password">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="d-flex justify-content-between">
                {{-- <a href="{{ route('signup.form') }}" style="text-decoration: none">Sign Up</a> --}}
                <a href="{{ route('forgotPasswordForm') }}" style="text-decoration: none">I forgot my password</a>
            </div>

        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->
@endsection
