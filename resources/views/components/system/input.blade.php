<div>
    <div class="form-group row {{ isset($input['divClass']) ? $input['divClass'] : '' }} {{ $input['class'] ?? '' }}">
        <label for="inputName"
            class="{{ isset($input['isModal']) ? 'col-sm-4' : 'col-sm-2' }} col-form-label {{ $input['label-class'] ?? '' }}">{{ isset($input['label']) ? $input['label'] : formatter($input['name']) }}
            <span class="text text-danger">
                {{ isset($input['required']) && $input['required'] == false ? '' : '*' }}
            </span>
        </label>

        <div class="{{ isset($input['isModal']) ? 'col-sm-8' : 'col-sm-10' }}">
            <input type="{{ $input['type'] ?? 'text' }}" class="form-control {{ $input['class'] ?? '' }}"
                name="{{ $input['name'] }}" id="{{ $input['id'] ?? $input['name'] }}"
                {{ isset($input['required']) && $input['required'] == false ? '' : 'required' }}
                value="{{ $input['value'] ?? '' }}"
                placeholder="{{ isset($input['placeholder']) ? $input['placeholder'] : formatter($input['name']) }}"
                {{ isset($input['readonly']) ? 'readonly' : '' }} autocomplete="off"
                {{ isset($input['autofocus']) && $input['autofocus'] === true ? 'autofocus' : '' }}>

            @if (isset($input['message']))
                <div>
                    <span class="text text-secondary">
                        {{ $input['message'] }}
                    </span>
                </div>
            @endif
            @error($input['name'])
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
