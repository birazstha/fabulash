@extends('system.layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card ml-3 mr-3">
                    <div class="card-header">

                        <h3 class="card-title">
                            Manage Frontend Config
                        </h3>
                        <div class="card-title">
                            @yield('search')
                        </div>
                        <div class="card-tools">
                        @section('create')
                            @if (checkPermission($indexUrl . '/create', 'POST'))
                                <a href="{{ url($indexUrl . '.create') }}" class="btn btn-success btn-sm"><i
                                        class="fa fa-plus"></i> Add</a>
                            @endif
                        @show
                        <a href="{{ url()->previous() }}" class="btn btn-info btn-sm back-btn"><i
                                class="fas fa-chevron-left"></i> Back</a>
                    </div>
                </div>

                <div class="card-body">
                    @yield('data')
                </div>
            </div>
        </div>
</section>
@endsection
