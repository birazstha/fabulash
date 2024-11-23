@extends('system.layouts.form')

@section('form')
    <input type="hidden" name="id" value="{{ $item->id ?? '' }}">

    {{-- Role --}}
    <x-system.select :input="[
        'name' => 'role_id',
        'required' => true,
        'options' => $roles ?? [],
        'value' => $item->role_id ?? old('role_id'),
    ]" />

    {{-- Name --}}
    <x-system.input :input="[
        'name' => 'name',
        'required' => true,
        'value' => $item->name ?? old('name'),
    ]" />

    {{-- Email --}}
    <x-system.input :input="[
        'name' => 'email',
        'required' => true,
        'value' => $item->email ?? old('email'),
    ]" />


    <div class="{{ isset($item) ? 'd-none' : '' }}">
        {{-- Setup Method? --}}
        <x-system.radio :input="[
            'label' => 'Setup Method',
            'required' => true,
            'name' => 'setup_method',
            'options' => $setupMethods ?? [],
            'value' => $item->setup_method ?? 'set_password',
        ]" />

        <div class="toggle-password">
            {{-- Password --}}
            <x-system.input :input="[
                'name' => 'password',
                'type' => 'password',
                'required' => true,
                'value' => $item->password ?? old('password'),
            ]" />

            {{-- Confirm Password --}}
            <x-system.input :input="[
                'name' => 'confirm_password',
                'type' => 'password',
                'required' => true,
                'value' => $item->confirm_password ?? old('confirm_password'),
            ]" />
        </div>
    </div>

    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'required' => true,
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />
@endsection

@section('js')
    <script>
        $(document).on('change', '#setup_method', function() {
            let method = $(this).val();
            if (method === 'set_password') {
                $('.toggle-password').removeClass('d-none');
                $('#password').attr('required', 'required');
                $('#confirm_password').attr('required', 'required');

            } else {
                $('.toggle-password').addClass('d-none');
                $('#password').removeAttr('required');
                $('#confirm_password').removeAttr('required');
            }
        });
    </script>
@endsection
