@extends('system.layouts.index')

@section('create')
@endsection

@section('search')
    <x-system.form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.select-search :input="[
                'name' => 'user_id',
                'label' => 'User',
                'required' => true,
                'options' => $users ?? [],
                'value' => Request::input('user_id') ?? old('user_id'),
            ]" />
        </x-slot>
    </x-system.form>
@endsection

@section('headings')
    <th> S.N</th>
    <th> Activity</th>
    <th> Date</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{!! '<b>' . $item->user->name . '</b>' . ' ' . $item->event . ' ' . $item->log_name !!}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
@endsection
