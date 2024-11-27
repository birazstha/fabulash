@extends('system.layouts.form')

@section('form')
    {{-- Title --}}
    <x-system.input :input="[
        'name' => 'title',
        'required' => true,
        'value' => $item->title ?? old('title'),
        'autofocus' => true,
    ]" />

    {{-- Description --}}
    <x-system.textarea :input="[
        'name' => 'description',
        'required' => true,
        'value' => $item->description ?? old('description'),
    ]" />

    {{-- Rank --}}
    <x-system.input :input="[
        'name' => 'rank',
        'type' => 'number',
        'required' => true,
        'value' => $item->rank ?? old('rank'),
    ]" />

    {{-- Image --}}
    <x-system.image :input="[
        'name' => 'photo',
        'required' => isset($item) ? false : true,
        'value' => $item->files ?? null,
        'folder' => $indexUrl,
    ]" />

    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />
@endsection

@section('js')
    <script>
        $(document).on('change', '#has_content', function() {
            let value = $(this).val();
            if (value == 0) {
                $('.toggle-content').addClass('d-none');
            } else {
                $('.toggle-content').removeClass('d-none');
            }
        })
    </script>
@endsection
