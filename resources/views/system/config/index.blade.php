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

@section('headings')
    <th>S.N</th>
    <th>Label</th>
    <th>Slug</th>
    <th class="w-25">Value</th>
    <th>Action</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->label }}</td>
            <td>{{ $item->slug ?? 'N/A' }}</td>
            <td style="max-width: 400px; overflow: hidden; text-overflow: ellipsis;">
                @if ($item->type === 'file')
                    <img src="{{ asset('uploads/config/' . $item->value) }}" width="100px" class="img-thumbnail"
                        alt="{{ $item->value }}">
                @else
                    {{ $item->value }}
                @endif
            </td>
            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
            </td>
        </tr>
    @endforeach
@endsection
