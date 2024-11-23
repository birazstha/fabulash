@extends('system.layouts.index')

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">

            <x-system.search :input="[
                'name' => 'keyword',
                'value' => Request::input('keyword') ?? old('keyword'),
                'placeholder' => 'Enter Keyword',
            ]" />

            <x-system.select-search :input="[
                'name' => 'role_id',
                'label' => 'Role',
                'options' => $roles ?? [],
                'value' => Request::input('role_id') ?? old('role_id'),
            ]" />
        </x-slot>
    </x-system.form>
@endsection

@section('headings')
    <th>S.N</th>
    <th> Name</th>
    <th> Username</th>
    <th> Role</th>
    <th> Password Status</th>
    <th> Account Status</th>
    @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') ||
            checkPermission($indexUrl . '/*', 'DELETE') ||
            checkPermission('resend-password/*', 'GET'))
        <th> Action</th>
    @endif
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->username ?? '' }}</td>
            <td>
                @if ($item->role->slug === 'super_admin')
                    <p class="badge badge-success">{{ Str::ucfirst($item->role->name) }}</p>
                @else
                    <p class="badge badge-info">{{ Str::ucfirst($item->role->name) }}</p>
                @endif
            </td>

            <td>
                @if ($item->is_password_set)
                    <span class="badge badge-success">Set</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </td>
            <td>{!! statusBadge($item, $indexUrl) !!}</td>
            @if (checkPermission($indexUrl . '/*' . '/edit', 'PUT') ||
                    checkPermission($indexUrl . '/*', 'DELETE') ||
                    checkPermission('resend-password/*', 'GET'))
                <td>
                    @include('system.partials.editButton')
                    @include('system.partials.deleteButton')

                    @if (checkPermission('resend-password/*', 'GET'))
                        <x-system.button :input="[
                            'title' => 'Resend Password',
                            'btnType' => 'info',
                            'anchor' => true,
                            'icon' => 'fas fa-recycle',
                            'disabled' => $item->is_password_set === 1,
                            'link' => [
                                'route' => 'resendPassword',
                                'params' => $item->id,
                            ],
                        ]" />
                    @endif
                </td>
            @endif

        </tr>
    @endforeach
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
