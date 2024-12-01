{{-- Facebook --}}
<x-system.input :input="[
    'name' => 'facebook',
    'required' => false,
    'value' => $item['facebook'] ?? old('facebook'),
]" />

{{-- Instagram --}}
<x-system.input :input="[
    'name' => 'instagram',
    'required' => false,
    'value' => $item['instagram'] ?? old('instagram'),
]" />

{{-- Twitter --}}
<x-system.input :input="[
    'name' => 'twitter',
    'required' => false,
    'value' => $item['twitter'] ?? old('twitter'),
]" />

{{-- Linkedin --}}
<x-system.input :input="[
    'name' => 'LinkedIn',
    'required' => false,
    'value' => $item['linkedin'] ?? old('linkedin'),
]" />
