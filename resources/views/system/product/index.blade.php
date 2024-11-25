@extends('system.layouts.index')

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.search :input="[
                'name' => 'keyword',
                'value' => Request::input('keyword'),
                'placeholder' => 'Enter Keyword',
            ]" />

            <x-system.select-search :input="[
                'name' => 'category_id',
                'required' => true,
                'options' => $users ?? [],
                'value' => Request::input('category_id') ?? old('category_id'),
            ]" />

            <x-system.select-search :input="[
                'name' => 'sub_category_id',
                'width' => '180px',
                'required' => true,
                'options' => $users ?? [],
                'value' => Request::input('sub_category_id') ?? old('sub_category_id'),
            ]" />

        </x-slot>
    </x-system.form>
@endsection

@section('headings')
    <th>S.N</th>
    <th>Title</th>
    <th>Price</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ convertToAmount($item->price) }}</td>
            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
                @include('system.partials.showButton')
            </td>
        </tr>
    @endforeach
@endsection
