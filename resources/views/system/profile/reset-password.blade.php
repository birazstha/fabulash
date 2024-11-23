<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ geConfig('cms-title') }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>{{ geConfig('cms-title') }}</b>z
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @error('error')
                    <p class=" text text-danger text-center">{{ $message }}</p>
                @enderror

                <form method="POST" action="{{ route('resetPassword') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            value="{{ old('password') }}" autofocus placeholder="New Password">

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
                            value="{{ old('confirm_password') }}" autofocus placeholder="Confirm Password">

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
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://kit.fontawesome.com/f0dad6a07d.js" crossorigin="anonymous"></script>

</body>

</html>
