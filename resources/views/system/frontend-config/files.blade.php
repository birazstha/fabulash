<x-system.file :input="[
    'name' => 'file[ceo_image]',
    'label' => 'C.E.O Image',
    'fileTypes' => 'image/jpg,image/jpeg,image/png',
    'value' => fileName('ceo_image') ?? old('ceo_image'),
    'folder' => $indexUrl,
    'previewClass' => 'ceo_image',
]" />

<x-system.file :input="[
    'name' => 'file[small_image]',
    'label' => 'Small Image',
    'fileTypes' => 'image/jpg,image/jpeg,image/png',
    'value' => fileName('small_image') ?? old('small_image'),
    'folder' => $indexUrl,
    'previewClass' => 'small-preview',
]" />
