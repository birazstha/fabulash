@extends('system.layouts.index')

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.search :input="[
                'name' => 'keyword',
                'value' => Request::input('keyword'),
                'placeholder' => 'Enter Keyword',
            ]" />


            <input type="hidden" id="old_category_id" value="{{ request()->category_id }}">
            <input type="hidden" id="old_sub_category_id" value="{{ request()->sub_category_id }}">

            <x-system.select-search :input="[
                'name' => 'category_id',
                'options' => $categories ?? [],
                'value' => Request::input('category_id') ?? old('category_id'),
            ]" />

            <x-system.select-search :input="[
                'name' => 'sub_category_id',
                'width' => '180px',
                'options' => [],
                'value' => Request::input('sub_category_id'),
            ]" />

        </x-slot>
    </x-system.form>
@endsection

@section('headings')
    <th>S.N</th>
    <th>Title</th>
    <th>Category</th>
    <th>Sub Category</th>
    <th>Price</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->subCategory->parent->title }}</td>
            <td>{{ $item->subCategory->title }}</td>
            <td>{{ convertToAmount($item->price) }}</td>
            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
                @include('system.partials.showButton')
            </td>
        </tr>
    @endforeach
@endsection

@section('js')
    <script src="{{ asset('compiledCssAndJs/js/categories.js') }}"></script>
@endsection
