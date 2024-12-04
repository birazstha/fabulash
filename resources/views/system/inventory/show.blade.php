@extends('system.layouts.show')

@section('back')


@show

@section('content-first-left')
    {{-- Name --}}
    <x-system.detail :input="[
        'label' => 'Name',
        'value' => $item->product->title ?? 'N/A',
    ]" />

    {{-- Category --}}
    <x-system.detail :input="[
        'label' => 'Category',
        'value' => $item->product->category->title ?? 'N/A',
    ]" />

@endsection

@section('content-first-right')
    {{-- Created At --}}
    <x-system.detail :input="[
        'label' => 'Created At',
        'value' => $item->created_at ?? '-',
    ]" />
@endsection

@section('content-second')
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h3>Inventory Log</h3>

        <div>
            {{-- Add --}}
            <x-system.modal :input="[
                'modalTitle' => 'Add Inventory',
                'btnTitle' => 'Add',
                'btnColor' => 'success',
                'route' => 'inventories.add',
                'icon' => 'fas fa-upload',
                'method' => 'post',
                'id' => 'uploadTeachers',
            ]">
                <x-slot name="body">
                    <div class="text-start">
                        <x-system.input :input="[
                            'name' => 'quantity',
                            'required' => true,
                            'isModal' => true,
                        ]" />
                    </div>
                </x-slot>
            </x-system.modal>

            {{-- Remove --}}
            <x-system.modal :input="[
                'modalTitle' => 'Add Inventory',
                'btnTitle' => 'Deduct',
                'btnColor' => 'danger',
                'route' => 'categories.index',
                'icon' => 'fas fa-minus',
                'method' => 'post',
                'id' => 'uploadTeachers',
            ]">
                <x-slot name="body">
                    <div class="text-start">
                        <x-system.input :input="[
                            'name' => 'quantity',
                            'required' => true,
                            'isModal' => true,
                        ]" />
                    </div>
                </x-slot>
            </x-system.modal>
        </div>

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



        </tbody>
    </table>
@endsection
