@extends('system.layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card ml-3 mr-3">
                    <div class="card-header">
                        <div class="card-title">
                            @yield('search')
                        </div>
                        <div class="card-tools">
                        @section('create')
                            @if (checkPermission($indexUrl . '/create', 'GET'))
                                <a href="{{ url($indexUrl . '/create') }}" class="btn btn-success btn-sm mr-1"><i
                                        class="fa fa-plus"></i> Add</a>
                            @endif

                            <a href="{{ url()->previous() }}" class="btn btn-info btn-sm back-btn"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        @show
                    </div>

                </div>
                <!-- /.card-header -->

                {{-- <div class="card"> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first() }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @yield('headings')
                                </tr>
                            </thead>
                            <tbody>

                                @if ($items->isEmpty())
                                    <tr>
                                        <td colspan="100%" class="text-center text-danger">No data found.</td>
                                    </tr>
                                @else
                                    @yield('data')
                                @endif

                            </tbody>
                        </table>
                    </div>

                    @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ isset($items) ? $items->withQueryString()->links() : '' }}
                    @endif


                </div>
                {{-- </div> --}}
            </div>
        </div>

</section>
@endsection
