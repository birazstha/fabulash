@extends('system.layouts.show')

@section('content-first-left')
    {{-- Name --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'value' => $item->name ?? 'N/A',
    ]" />

    {{-- Address --}}
    <x-system.detail :input="[
        'label' => 'Address',
        'value' => $item->address ?? 'N/A',
    ]" />

    {{-- Contact Number --}}
    <x-system.detail :input="[
        'label' => 'Contact Number',
        'value' => $item->contact_number ?? 'N/A',
    ]" />
@endsection

@section('content-first-right')
    {{-- Created By --}}
    <x-system.detail :input="[
        'label' => 'Email',
        'value' => $item->email ?? '-',
    ]" />

    {{-- Created At --}}
    <x-system.detail :input="[
        'label' => 'Created At',
        'value' => $item->created_at ?? '-',
    ]" />
@endsection

@section('content-second')
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Order History</h3>
        <a href="{{ $indexUrl . '/create?product_id=' . $item->id }}" class="btn btn-info btn-sm">
            <i class="fa fa-plus"></i>&nbsp; Add
        </a>


    </div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <td scope="col">1</td>
                <td scope="col">2J423J3</td>
                <td scope="col">2024-01-01</td>
                <td scope="col">
                    <a href="" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>
@endsection
