@extends('system.layouts.show')

@section('content-first-left')
    {{-- Title --}}
    <x-system.detail :input="[
        'label' => 'Title',
        'value' => $item->title ?? 'N/A',
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

    {{-- Created By --}}
    <x-system.detail :input="[
        'label' => 'Created By',
        'value' => $item->createdBy->name ?? 'N/A',
    ]" />

    {{-- Status --}}
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
        <h3>Pictures</h3>
        <a href="{{ $indexUrl . '/create?gallery_id=' . $item->id }}" class="btn btn-info btn-sm">
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
                                width="100px">
                        </a>
                    </td>
                    <td scope="col">
                        <x-system.delete :input="[
                            'btnColor' => 'primary',
                            'id' => 'delete-file-' . $image->id,
                            'btnTitle' => 'Delete',
                            'isConfirmation' => true,
                            'indexUrl' => 'files',
                            'itemId' => $image->id,
                        ]" />

                        <a href="{{ route('files.edit', $image->id) }}" class="btn btn-warning btn-sm"><i
                                class="fa fa-pen"></i> Edit</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
