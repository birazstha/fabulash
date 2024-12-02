@extends('system.layouts.master')


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card ml-3 mr-3">
                    <div class="card-header">
                        <div class="card-title">
                        @section('title')
                            <h3> {{ $moduleName }} Details</h3>
                        @show
                    </div>

                    <div class="card-tools">
                        @section('back')
                            @include('system.partials.createButton')
                            @include('system.partials.editButton')

                        @show
                        <a href="{{ url()->previous() }}" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i>
                            Back</a>
                    </div>
                </div>


                <div class="card-body">
                    @yield('content-first-title')
                    <div class="row">
                        <div class="col-12">
                            @yield('content-first')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            @yield('content-first-left')
                        </div>
                        <div class="col-6">
                            @yield('content-first-right')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @yield('content-second')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @yield('content-third')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @yield('content-fourth')
                        </div>
                    </div>
                </div>



            </div>
        </div>
</section>
@endsection
