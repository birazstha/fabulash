@extends('system.layouts.master')

@section('content')
    <section class="content">
        <div class="card ml-3 mr-3">
            <div class="card-header">
                <h3 class="card-title">
                    {{ isset($item) ? 'Update' : 'Create' }} {{ $moduleName }}
                </h3>

                <div class="card-tools">
                    <a href="{{ url($indexUrl) }}" class="btn btn-primary btn-sm mr-1"><i class="fa fa-list"></i>
                        List</a>
                    <a href="{{ url()->previous() }}" class="btn btn-info btn-sm"><i class="fas fa-chevron-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <form class="form-horizontal" method="POST"
                    action="{{ isset($item) ? url($indexUrl . '/' . $item->id) : url($indexUrl) }}"
                    enctype="multipart/form-data">

                    @if (isset($item))
                        @method('PUT')
                    @endif
                    @csrf
                    @yield('form')
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit"
                                class="btn {{ isset($item) ? 'btn-primary' : 'btn-success' }} btn-sm mr-1 action-btn"> <i
                                    class="fas  {{ isset($item) ? 'fa-recycle' : 'fa-plus' }}"></i>
                                {{ isset($item) ? 'Update' : 'Create' }}</button>
                            <button type="reset" class="btn btn-info btn-sm"><i class="fas fa-times"></i>
                                Clear</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.card -->

    </section>
@endsection
