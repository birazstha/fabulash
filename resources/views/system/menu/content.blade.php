<form id="updateForm" action=" {{ isset($content) ? route('contents.update', $content->id) : route('contents.store') }}"
    method="POST" novalidate enctype="multipart/form-data">
    @if (isset($content))
        @method('PUT')
    @endif
    @csrf
    <div class="form-group row">
        {{-- Content Type --}}
        <x-system.select :input="[
            'name' => 'content_type_id',
            'required' => true,
            'label' => 'Content Type',
            'options' => $contentTypes ?? [],
            'value' => $content->content_type_id ?? old('content_type_id'),
        ]" />

        {{-- Content --}}
        <x-system.textarea :input="[
            'name' => 'content_english',
            'required' => true,
            'label' => 'Description',
            'class' => 'editor_desc_eng',
            'value' => $content->content_english ?? old('content_english'),
        ]" />

    
        {{-- Image --}}
        <x-system.file :input="[
            'name' => 'image',
            'class' => 'd-none toggle-image',
            'required' => true,
            'value' => $content ?? old('image'),
            'path' => 'uploads/images',
        ]" />

        <input type="hidden" value="{{ request()->menuId }}" name="menu_id">
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit"
                class="btn {{ isset($content) ? 'btn-primary' : 'btn-success' }} btn-sm mr-1 submit-button"> <i
                    class="fas  {{ isset($content) ? 'fa-recycle' : 'fa-plus' }}"></i>
                {{ isset($content) ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>
