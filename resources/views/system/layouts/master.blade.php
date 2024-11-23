<!DOCTYPE html>
<html>

@include('system.layouts.layoutHeader')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home.index') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Profile/Logo -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{ Auth::user()->name }}
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-user-alt"></i> Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo Starts -->
            <a href="{{ route('home.index') }}" class="brand-link" target="_blank">
                {{-- <img src="{{ asset('uploads/config/' . getConfig('cms-logo')) }}" alt="AdminLTE Logo"
                    class="" style="opacity: .8; " height="200px">
                    <span>&nbsp;</span> --}}
                {{-- <span class="brand-text font-weight-light">{{ getConfig('cms-title') }}</span> --}}

                <div class="text-center">
                  <img src="{{ asset('uploads/config/' . getConfig('cms-logo-white')) }}" alt="AdminLTE Logo"
                    class="" style="opacity: .8; " height="75px">
                    <span>&nbsp;</span>
                </div>

            </a>
            <!-- Brand Logo Ends -->

            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('system.partials.sidebar')
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Sidebar -->

        @include('system.layouts.breadcrumb')

        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy;{{ \Carbon\Carbon::now()->format('Y') }} <a href="https://birajshrestha.com.np"
                target="_blank">Biraj
                Shrestha</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    @include('system.layouts.layoutFooter')

    <script>
        $(document).on('click', '.action-btn', function(event) {
            event.preventDefault();
            var button = $(this);
            var form = button.closest('form')[0];
            var icon = button.find('i');
            var originalIconClass = icon.attr('class');

            if (form.checkValidity()) {
                button.prop('disabled', true);
                icon.attr('class', 'fas fa-spinner fa-spin');
                form.submit();
                form.reportValidity();
            }
        });
    </script>



</body>

</html>
