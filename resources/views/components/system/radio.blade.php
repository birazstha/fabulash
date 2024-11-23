<div>
    <div class="form-group row {{ isset($input['divClass']) ? $input['divClass'] : '' }}">
        <label for="inputName"
            class="{{ isset($input['isModal']) ? 'col-sm-4' : 'col-sm-2' }} col-form-label">{{ isset($input['label']) ? $input['label'] : ucfirst(str_replace('_', ' ', $input['name'])) }}
            <span class="text text-danger">
                {{ isset($input['required']) ? '*' : '' }}
            </span>
        </label>
        <div class="{{ isset($input['isModal']) ? 'col-sm-8' : 'col-sm-10' }} d-flex">
            @foreach ($input['options'] as $option)
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" value="{{ $option['value'] }}"
                        name="{{ $input['name'] }}" id="{{ $input['name'] }}"
                        {{ $option['value'] == $input['value'] ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $input['name'] }}">
                        {{ $option['label'] }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
