@extends('system.layouts.index')

@section('create')
@endsection

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.search :input="[
                'name' => 'order_number',
                'value' => Request::input('order_number') ?? old('order_number'),
                'placeholder' => 'Enter Order ID',
            ]" />

            {{-- Date --}}
            <x-system.search :input="[
                'name' => 'dates',
                'required' => true,
                'value' => Request::input('dates') ?? old('dates'),
            ]" />

        </x-slot>
    </x-system.form>
@endsection

@section('headings')
    <th>S.N</th>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Total Amount</th>
    <th>Order At</th>
    <th>Payment Status</th>
    <th>Delivery Status</th>
    @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') || checkPermission($indexUrl . '/*', 'DELETE'))
        <th>Action</th>
    @endif
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{!! $item->order_number ?? 'N/A' !!}</td>
            <td>
                <a href="{{ route('customers.show', $item->customer->id) }}"> {{ $item->customer->name ?? 'N/A' }}</a>
            </td>
            <td>{{ convertToAmount($item->total_amount) ?? 'N/A' }}</td>
            <td>{{ convertToTime($item->created_at) ?? 'N/A' }}</td>
            <td>
                @if ($item->payment_status == 'unverified')
                    <span class="badge badge-warning">Unverified</span>
                @elseif($item->payment_status == 'verified')
                    <span class="badge badge-success">Verified</span>
                @elseif($item->payment_status == 'rejected')
                    <span class="badge badge-danger">Rejected</span>
                @endif
            </td>
            <td>
                @if ($item->delivery_status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($item->delivery_status == 'shipped')
                    <span class="badge badge-info">Shipped</span>
                @elseif($item->delivery_status == 'delivered')
                    <span class="badge badge-success">Delivered</span>
                @elseif($item->delivery_status == 'canceled')
                    <span class="badge badge-danger">Canceled</span>
                @endif
            </td>
            @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') || checkPermission($indexUrl . '/*', 'DELETE'))
                <td class="d-flex justify-content-center">
                    @include('system.partials.editButton')
                    @include('system.partials.deleteButton')
                    @include('system.partials.showButton')
                </td>
            @endif
        </tr>
    @endforeach
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            const inputField = $('input[name="dates"]');
            inputField.daterangepicker({
                autoUpdateInput: false, // Prevents auto-population
                opens: 'left',
                locale: {
                    format: 'YYYY/MM/DD' // Specifies the date format
                }
            });

            // On showing the date range picker, prefill with '2024/01/01'
            inputField.on('show.daterangepicker', function(ev, picker) {
                picker.setStartDate('2024/01/01');
                picker.setEndDate('2024/01/01');
            });

            // Update the input field on apply
            inputField.on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format(
                    'YYYY/MM/DD'));
            });

            // Clear the input field on cancel
            inputField.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
