@extends('system.layouts.index')

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.search :input="[
                'name' => 'keyword',
                'value' => Request::input('keyword'),
                'placeholder' => 'Enter Keyword',
            ]" />
        </x-slot>
    </x-system.form>
@endsection


@section('headings')
    <th>S.N</th>
    <th>Title</th>
    <th>Status</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->title }}</td>
            <td>{!! statusBadge($item, $indexUrl) !!}</td>
            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
                {{-- <a href="{{ route('sub-categories.index', $item->id) }}" class="btn btn-info btn-sm">Sub Category
                    ({{ $item->subCategories->count() }})
                </a> --}}
            </td>
        </tr>
    @endforeach
@endsection
