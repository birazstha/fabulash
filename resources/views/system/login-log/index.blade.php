@extends('system.layouts.index')

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
    <th>S.N</th>
    <th>UserName</th>
    <th>Location</th>
    <th>ISP</th>
    <th>Cordindates</th>
    <th>Time</th>
@endsection

@section('data')
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->user->name ?? 'N/A' }}</td>
            <td>
                <div>
                    <b>Country:</b>{{ $item->location['country'] ?? 'N/A' }}
                </div>
                <div>
                    <b>Province:</b>{{ $item->location['province'] ?? 'N/A' }}
                </div>
                <div>
                    <b>Province:</b>{{ $item->location['city'] ?? 'N/A' }}
                </div>
            </td>
            <td>{{ $item->isp ?? 'N/A' }}</td>
            <td>{{ $item->coordinates ?? 'N/A' }}</td>
            <td>{{ $item->created_at ?? 'N/A' }}</td>
        </tr>
    @endforeach
@endsection
