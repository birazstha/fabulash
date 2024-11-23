<div>
    <div class="form-group row">
        <label for="inputName"
            class="{{ isset($input['isModal']) ? 'col-sm-4' : 'col-sm-2' }}  }} col-form-label">{{ isset($input['label']) ? $input['label'] : formatter($input['name']) }}
            <span class="text text-danger">
                {{ isset($input['required']) ? '*' : '' }}
            </span>
        </label>

        <div class="{{ isset($input['isModal']) ? 'col-sm-8' : 'col-sm-10' }}">
            <select name="{{ $input['name'] }}" id="{{ $input['id'] ?? $input['name'] }}"
                {{ isset($input['required']) ? 'required' : '' }} class="form-control">
                @if (!isset($input['hidePlaceholder']))
                    <option value="">
                        {{ isset($input['placeholder']) ? $input['placeholder'] : '-- Select ' . (isset($input['label']) ? $input['label'] . ' --' : (isset($input['name']) ? formatter($input['name']) . ' --' : '--')) }}
                    </option>
                @endif
                @foreach ($input['options'] as $key => $value)
                    <option value="{{ $key }}" {{ $key == $input['value'] ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
            @error($input['name'])
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
