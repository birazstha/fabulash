 {{-- Name --}}
 <x-system.input :input="[
     'name' => 'company_name',
     'required' => false,
     'value' => $item['company_name'] ?? old('company_name'),
 ]" />

 {{-- Slogan --}}
 <x-system.input :input="[
     'name' => 'slogan',
     'required' => false,
     'value' => $item['slogan'] ?? old('slogan'),
 ]" />

 {{-- Menu Logo --}}
 {{-- <x-system.file :input="[
     'label' => 'Header Logo',
     'name' => 'file[header_logo]',
     'fileTypes' => 'image/png',
     'value' => fileName('header_logo') ?? old('header_logo'),
     'folder' => $indexUrl,
     'previewClass' => 'header_logo',
 ]" /> --}}

 {{-- <x-system.file :input="[
     'label' => 'Footer Logo',
     'name' => 'file[footer_logo]',
     'fileTypes' => 'image/png',
     'value' => fileName('footer_logo') ?? old('footer_logo'),
     'folder' => $indexUrl,
     'previewClass' => 'footer_logo',
 ]" /> --}}


 {{-- Header Logo --}}
 <x-system.image :input="[
     'name' => 'header_logo',
     'required' => isset($item) ? false : true,
     'value' => null,
     'folder' => $indexUrl,
 ]" />

 {{-- Footer Logo --}}
 <x-system.image :input="[
     'name' => 'footer_logo',
     'required' => isset($item) ? false : true,
     'value' => null,
     'folder' => $indexUrl,
 ]" />




 {{-- Message --}}
 <x-system.input :input="[
     'name' => 'message_for_intereste_applicant',
     'required' => false,
     'value' => $item['message_for_intereste_applicant'] ?? old('message_for_intereste_applicant'),
 ]" />
