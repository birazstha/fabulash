@extends('system.layouts.form')



@section('form')
    {{-- Label --}}
    <x-system.input :input="[
        'name' => 'label',
        'required' => true,
        'value' => $item->label ?? old('label'),
        'autofocus' => true,
    ]" />

    {{-- Slug --}}
    <x-system.input :input="[
        'name' => 'slug',
        'required' => true,
        'value' => $item->slug ?? old('slug'),
    ]" />

    {{-- Content Type --}}
    <x-system.select :input="[
        'name' => 'type',
        'required' => true,
        'label' => 'Config Type',
        'options' => ['text' => 'Text', 'file' => 'File'] ?? [],
        'value' => $item->type ?? old('type'),
    ]" />

    <div class="toggle-text {{ isset($item) && $item->type === 'text' ? '' : 'd-none' }}">
        <x-system.input :input="[
            'name' => 'value',
            'label' => 'Text',
            'value' => $item->value ?? old('value'),
        ]" />
    </div>


    <div class="form-group row toggle-file {{ isset($item) && $item->type === 'file' ? '' : 'd-none' }}">
        <label for="inputName" class="col-sm-2 col-form-label">Image <span class="text text-danger">*</span>
        </label>
        <div class="col-sm-10">
            <input type="file" class="form-control mb-2" name="value" onchange="previewImage(event)" id="imageInput"
                accept="image/jpg,image/jpeg,image/png">
            <img id="preview" src="{{ isset($item) ? asset('uploads/config/' . $item->value) : '' }}" width="200px"
                class="img-thumbnail" alt="...">
        </div>
    </div>
@endsection

@section('js')
    <script>
        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewImg = document.getElementById('preview');
                    previewImg.setAttribute('src', e.target.result);
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script>
        $(document).on('change', '#type', function() {
            let type = $(this).val();
            if (type === 'text') {
                $('.toggle-text').removeClass('d-none');
                $('.toggle-file').addClass('d-none');
            } else {
                $('.toggle-file').removeClass('d-none');
                $('.toggle-text').addClass('d-none');
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#label').on('keyup', function() {
                var label = $(this).val().toLowerCase().trim();
                var slug = label.replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
                $('#slug').val(slug);
            });
        });
    </script>
@endsection
