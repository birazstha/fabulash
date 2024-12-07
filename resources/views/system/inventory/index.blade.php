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
    <th>Product</th>
    <th>Transaction Type</th>
    <th>Quantity</th>
    <th>User</th>
    <th>Date</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{!! showLink($item->product, 'products') !!}</td>
            <td>{{ $item->transaction_type }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ convertToTime($item->created_at) }}</td>
            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
            </td>
        </tr>
    @endforeach
@endsection

@section('js')
    <script src="{{ asset('compiledCssAndJs/js/categories.js') }}"></script>
@endsection
