<h3>Main Office</h3>
<hr>

{{-- Location --}}
<x-system.input :input="[
    'name' => 'location',
    'required' => false,
    'label' => 'Address',
    'value' => $item['location'] ?? old('location'),
]" />

{{-- Contact --}}
<x-system.input :input="[
    'name' => 'contact',
    'required' => false,
    'value' => $item['contact'] ?? old('contact'),
]" />

{{-- Email --}}
<x-system.input :input="[
    'name' => 'email',
    'required' => false,
    'type' => 'email',
    'value' => $item['email'] ?? old('email'),
]" />

<hr>
<h3>Branch Office</h3>
<hr>

{{-- Location --}}
<x-system.input :input="[
    'name' => 'branch_location',
    'required' => false,
    'label' => 'Address',
    'value' => $item['branch_location'] ?? old('branch_location'),
]" />

{{-- Contact --}}
<x-system.input :input="[
    'name' => 'branch_contact',
    'required' => false,
    'label' => 'Contact',
    'value' => $item['branch_contact'] ?? old('branch_contact'),
]" />
