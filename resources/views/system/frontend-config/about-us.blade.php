 {{-- Name --}}
 <x-system.input :input="[
     'name' => 'title',
     'required' => false,
     'value' => $item['title'] ?? old('title'),
     'autofocus' => true,
 ]" />

 {{-- Description --}}
 <x-system.textarea :input="[
     'name' => 'description',
     'required' => false,
     'value' => $item['description'] ?? old('description'),
 ]" />

 {{-- Image --}}
 <x-system.file :input="[
     'name' => 'file[image]',
     'required' => false,
     'label' => 'Image',
     'fileTypes' => 'image/jpg,image/jpeg,image/png',
     'value' => fileName('image') ?? old('image'),
     'folder' => $indexUrl,
 ]" />
