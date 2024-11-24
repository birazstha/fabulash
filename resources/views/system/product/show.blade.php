@extends('system.layouts.show')

@section('content-first-left')
    {{-- Name --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'value' => $item->title ?? 'N/A',
    ]" />

    {{-- Category --}}
    <x-system.detail :input="[
        'label' => 'Category',
        'value' => $item->subCategory->parent->title ?? 'N/A',
    ]" />

    {{-- Sub Category --}}
    <x-system.detail :input="[
        'label' => 'Sub Category',
        'value' => $item->subCategory->title ?? 'N/A',
    ]" />

    {{-- Price --}}
    <x-system.detail :input="[
        'label' => 'Price',
        'value' => convertToAmount($item->price) ?? 'N/A',
    ]" />
@endsection

@section('content-first-right')
    {{-- Created At --}}
    <x-system.detail :input="[
        'label' => 'Created At',
        'value' => $item->created_at ?? '-',
    ]" />

    {{-- Created By --}}
    <x-system.detail :input="[
        'label' => 'Created By',
        'value' => $item->user->name ?? '-',
    ]" />
@endsection

@section('content-second')
    <hr>
    <h3>Product Images</h3>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($item->files as $file)
                <tr class="text-center">
                    <th scope="row">1</th>
                    <td>
                        <a href="{{ asset($file->path) }}" class="image-link">
                            <img src="{{ asset($file->path) }}" alt="" class="img-thumbnail" width="150px">
                        </a>
                    </td>
                    <td>Otto</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
