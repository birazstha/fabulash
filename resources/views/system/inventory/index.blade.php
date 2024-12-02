@extends('system.layouts.index')

@section('create')
@endsection


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
    <th>Stock</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{!! showLink($item->product, 'products') !!}</td>
            <td>{{ $item->current_stock }}</td>
            <td>
                @include('system.partials.showButton')
                
            </td>
        </tr>
    @endforeach
@endsection

@section('js')
    <script src="{{ asset('compiledCssAndJs/js/categories.js') }}"></script>
@endsection
