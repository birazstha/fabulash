@extends('system.layouts.show')

@section('content-first-left')
    {{-- Title --}}
    <x-system.detail :input="[
        'label' => 'Title',
        'value' => $item->title ?? 'N/A',
    ]" />

    {{-- Created By --}}
    <x-system.detail :input="[
        'label' => 'Created By',
        'value' => $item->createdBy->name ?? 'N/A',
    ]" />

    {{-- No of Files --}}
    <x-system.detail :input="[
        'label' => 'No of Files',
        'value' => $item->files->count() ?? 'N/A',
    ]" />
@endsection

@section('content-first-right')
    {{-- Created At --}}
    <x-system.detail :input="[
        'label' => 'Created At',
        'value' => convertToTime($item->created_at) ?? '-',
    ]" />

    {{-- Status --}}
    <x-system.detail :input="[
        'label' => 'Status',
        'value' => 'Active',
    ]" />
@endsection

@section('content-second')
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Pictures</h3>
        <a href="{{ $indexUrl . '/create?product_id=' . $item->id }}" class="btn btn-info btn-sm">
            <i class="fa fa-plus"></i>&nbsp; Add
        </a>
    </div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Picture</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item->files as $key => $image)
                <tr class="text-center">
                    <td scope="col">{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ asset($image->path . '/' . $image->title) }}" class="image-link">
                            <img src="{{ asset($image->path . '/' . $image->title) }}" alt="" class="img-thumbnail"
                                height="100px">
                        </a>
                    </td>
                    <td scope="col">
                        <a href="" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
