@extends('system.layouts.index')

@section('create')
@endsection

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

@section('headings')
    <th>S.N</th>
    <th>Name</th>
    <th>Contact Number</th>
    <th>Address</th>
    @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') || checkPermission($indexUrl . '/*', 'DELETE'))
        <th>Action</th>
    @endif
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->name ?? 'N/A' }}</td>
            <td>{{ $item->contact_number ?? 'N/A' }}</td>
            <td>{{ $item->address ?? 'N/A' }}</td>
            @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') || checkPermission($indexUrl . '/*', 'DELETE'))
                <td>
                    @include('system.partials.showButton')
                    @include('system.partials.deleteButton')
                </td>
            @endif
        </tr>
    @endforeach
@endsection
