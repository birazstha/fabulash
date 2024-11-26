@extends('system.layouts.form')

@section('form')
    {{-- English Title --}}
    <x-system.input :input="[
        'name' => 'title',
        'required' => true,
        'value' => $item->title ?? old('title'),
        'autofocus' => true,
    ]" />

    {{-- Href --}}
    <x-system.input :input="[
        'name' => 'href',
        'required' => true,
        'value' => $item->href ?? old('href'),
    ]" />

    {{-- Rank --}}
    <x-system.input :input="[
        'name' => 'rank',
        'type' => 'number',
        'required' => true,
        'value' => $item->rank ?? old('rank'),
    ]" />

    {{-- Is Menu? --}}
    <x-system.radio :input="[
        'label' => 'Is Link?',
        'required' => true,
        'name' => 'is_link',
        'options' => [
            [
                'value' => 1,
                'label' => 'Yes',
            ],
            [
                'value' => 0,
                'label' => 'No',
            ],
        ],
        'value' => $item->is_link ?? false,
    ]" />

    {{-- Link --}}
    <div class="toggle-link d-none">
        <x-system.input :input="[
            'name' => 'link',
            'required' => false,
            'value' => $item->link ?? old('link'),
        ]" />
    </div>

    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            function toggleLinkVisibility(isLink) {
                if (isLink == 1) {
                    $('.toggle-link').removeClass('d-none');
                } else {
                    $('.toggle-link').addClass('d-none');
                }
            }

            toggleLinkVisibility("{{ isset($item) ? $item->is_link : '' }}");

            $(document).on('change', '#is_link', function() {
                toggleLinkVisibility($(this).val());
            });
        });
    </script>
@endsection
