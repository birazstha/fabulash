@php
    if (isset($input['fileTypes'])) {
        $test = $input['fileTypes'];
        $mime_array = explode(',', $test);
        $file_extensions = [];
        foreach ($mime_array as $mime) {
            $parts = explode('/', $mime);
            $file_extensions[] = $parts[1];
        }
        $result = implode(', ', $file_extensions);
    }
@endphp

<div>
    <div class="form-group row {{ $input['divClass'] ?? '' }} {{ $input['class'] ?? '' }}">
        <label for="{{ $input['name'] }}_input"
            class="{{ isset($input['isModal']) && $input['isModal'] ? 'col-sm-4' : 'col-sm-2' }} col-form-label {{ $input['label-class'] ?? '' }}">
            {{ $input['label'] ?? Str::ucfirst($input['name']) }}
            <span class="text text-danger">
                {{ isset($input['required']) && $input['required'] ? '*' : '' }}
            </span>
        </label>

        <div class="{{ isset($input['isModal']) && $input['isModal'] ? 'col-sm-8' : 'col-sm-10' }}">
            <input {{ isset($input['isMultiple']) && isset($input['isMultiple']) == true ? 'multiple' : '' }} type="file"
                class="form-control {{ $input['uploadClass'] ?? '' }}" name="{{ $input['name'] }}"
                id="{{ $input['name'] }}_input"
                {{ isset($input['required']) && $input['required'] && !$input['value'] ? 'required' : '' }}
                onchange="previewImage('{{ $input['previewClass'] ?? $input['name'] }}', event)"
                accept="{{ $input['fileTypes'] ?? '' }}">

            <div class="text text-secondary" style="font-size: 15px">File must be in {{ $result ?? '' }} format.</div>

            <div>
                <img id="{{ $input['name'] }}_preview"
                    class="{{ !$input['value'] ? 'd-none' : '' }} mt-3 img-thumbnail p-2 {{ $input['previewClass'] ?? $input['name'] }}"
                    src="{{ isset($input['value']) ? asset('uploads/' . $input['folder'] . '/' . $input['value']->files()->value('title')) : '' }}"
                    width="300px" alt="...">
            </div>

            @error($input['name'])
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <input type="hidden" name="folder" value="{{ $input['folder'] }}">
</div>
