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

    <div class="row">
        <div class="col-sm-3">
            <label for="name">Status</label>
        </div>
        <div class="col-sm-9">
            <p>: &nbsp; &nbsp;
                {!! statusBadge($item, $indexUrl) !!}
            </p>
        </div>
    </div>
@endsection

@section('content-second')
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Product Images</h3>
        <a href="{{ $indexUrl . '/create?product_id=' . $item->id }}" class="btn btn-info btn-sm">
            <i class="fa fa-plus"></i>&nbsp; Add
        </a>


    </div>
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

            @forelse ($item->files as $key => $file)
                <tr class="text-center">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        <a href="{{ asset($file->path . '/' . $file->title) }}" class="image-link">
                            <img src="{{ asset($file->path . '/' . $file->title) }}" alt="" class="img-thumbnail"
                              height="100px">
                        </a>
                    </td>
                    <td>
                        <x-system.delete :input="[
                            'btnColor' => 'primary',
                            'id' => 'delete-file-' . $file->id,
                            'btnTitle' => 'Delete',
                            'isConfirmation' => true,
                            'indexUrl' => 'files',
                            'itemId' => $file->id,
                        ]" />

                        <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning btn-sm"><i
                                class="fa fa-pen"></i> Edit</a>
                    </td>
                </tr>

            @empty

                {!! noDataFound(3) !!}
            @endforelse

        </tbody>
    </table>
@endsection
