@extends('system.layouts.index')

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.search :input="[
                'name' => 'keyword',
                'value' => Request::input('keyword') ?? old('keyword'),
                'placeholder' => 'Enter Keyword',
            ]" />
        </x-slot>
    </x-system.form>
@endsection

@section('create')
    @if (checkPermission($indexUrl . '/create', 'POST'))
        <a href="{{ route($indexUrl . '.create', ['moduleId' => request()->moduleId]) }}" class="btn btn-success btn-sm"><i
                class="fa fa-plus"></i>
            Add</a>

        <a href="{{ url()->previous() }}" class="btn btn-info btn-sm back-btn"><i class="fas fa-chevron-left"></i> Back</a>
    @endif
@endsection


@section('headings')
    <th>S.N</th>
    <th>Title</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>
                @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT'))
                    {{-- <a href="{{ route($indexUrl . '.edit', $item->id.'?moduleId=1') }}" class="btn btn-success btn-sm mr-1"> <i
                            class="fas fa-pen"></i>
                    </a> --}}

                    <a href="{{ url('system/permissions/' . $item->id . '/edit?moduleId=' . request()->moduleId) }}"
                        class="btn btn-success btn-sm mr-1">
                        <i class="fas fa-pen"></i>
                    </a>
                @endif

                @include('system.partials.deleteButton')
            </td>
        </tr>
    @endforeach
@endsection
