@extends('system.layouts.show')

@section('back')
    @if ($item->files()->exists() && $item->payment_status == 'unverified')
        <x-system.modal :input="[
            'modalTitle' => 'Receipt',
            'btnTitle' => 'Receipt',
            'btnColor' => 'success',
            'route' => 'verify-payment',
            'icon' => 'fas fa-file-invoice',
            'method' => 'post',
            'size' => 'large',
            'submitBtn' => 'Verify',
            'id' => 'uploadTeachers',
        ]">
            <x-slot name="body">
                <div class="text-start">
                    <input type="hidden" name="order_number" value="{{ $item->order_number }}">
                    <img class="img-thumbnail" width="800px"
                        src="{{ asset($item->files()->value('path') . '/' . $item->files()->value('title')) }}"
                        alt="">
                </div>
            </x-slot>
        </x-system.modal>
    @endif
@endsection

@section('content-first-left')
    {{-- Order Code --}}
    <x-system.detail :input="[
        'label' => 'Order Code',
        'value' => $item->order_number ?? 'N/A',
    ]" />

    {{-- Customer --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'isLink' => true,
        'route' => 'customers.show',
        'id' => $item->customer->id,
        'value' => $item->customer->name ?? 'N/A',
    ]" />

    {{-- Customer --}}
    <x-system.detail :input="[
        'label' => 'Contact Number',
        'value' => $item->customer->contact_number ?? 'N/A',
    ]" />

    {{-- Total Amount --}}
    <x-system.detail :input="[
        'label' => 'Total Amount',
        'value' => convertToAmount($item->total_amount) ?? 'N/A',
    ]" />
@endsection

@section('content-first-right')
    {{-- Ordered At --}}
    <x-system.detail :input="[
        'label' => 'Ordered At',
        'value' => convertToTime($item->created_at) ?? '-',
    ]" />

    {{-- Delivery Address --}}
    <x-system.detail :input="[
        'label' => 'Delivery Address',
        'value' => $item->delivery_address,
    ]" />


    {{-- Payment Status --}}
    <div class="row">
        <div class="col-sm-3">
            <label for="name">Payment Status</label>
        </div>
        <div class="col-sm-9">
            <p>: &nbsp; &nbsp;
                @if ($item->payment_status == 'unverified')
                    <span class="badge badge-warning">Unverified</span>
                @elseif($item->payment_status == 'verified')
                    <span class="badge badge-success">Verified</span>
                @elseif($item->payment_status == 'rejected')
                    <span class="badge badge-warning">Rejected</span>
                @endif
            </p>
        </div>
    </div>

    {{-- Delivery Status --}}
    <div class="row">
        <div class="col-sm-3">
            <label for="name">Delivery Status</label>
        </div>
        <div class="col-sm-9">
            <p>: &nbsp; &nbsp;
                @if ($item->delivery_status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($item->delivery_status == 'shipped')
                    <span class="badge badge-info">Shipped</span>
                @elseif($item->delivery_status == 'delivered')
                    <span class="badge badge-success">Delivered</span>
                @elseif($item->delivery_status == 'canceled')
                    <span class="badge badge-danger">Canceled</span>
                @endif
            </p>
        </div>
    </div>
@endsection

@section('content-second')
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Products</h3>
        {{-- <a href="{{ $indexUrl . '/create?gallery_id=' . $item->id }}" class="btn btn-info btn-sm">
            <i class="fa fa-plus"></i>&nbsp; Add
        </a> --}}
    </div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Quantity</th>
                <th scope="col">Rate</th>
                <th scope="col">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item->orderProducts as $key => $orderProduct)
                <tr class="text-center">
                    <td scope="col">{{ $key + 1 }}</td>
                    <td scope="col">{{ $orderProduct->product->title }}</td>
                    <td scope="col">{{ $orderProduct->quantity . ' pc' }}</td>
                    <td scope="col">{{ convertToAmount($orderProduct->product->price) }}</td>
                    <td scope="col">{{ convertToAmount($orderProduct->product->price * $orderProduct->quantity) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-center"><strong>Grand Total</strong></td>
                <td class="text-center">
                    <strong>
                        {{ convertToAmount(
                            $item->orderProducts->sum(function ($orderProduct) {
                                return $orderProduct->product->price * $orderProduct->quantity;
                            }),
                        ) }}
                    </strong>
                </td>
            </tr>
        </tbody>

    </table>
@endsection
