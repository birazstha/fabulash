@extends('system.layouts.form')

@section('form')
    {{-- Category --}}
    <x-system.select :input="[
        'name' => 'product_id',
        'options' => $products ?? [],
        'value' => $item->product_id ?? old('product_id'),
        'autofocus' => true,
    ]" />

    {{-- Quantity --}}
    <x-system.input :input="[
        'name' => 'quantity',
        'type' => 'number',
        'value' => $item->quantity ?? old('quantity'),
    ]" />
@endsection
