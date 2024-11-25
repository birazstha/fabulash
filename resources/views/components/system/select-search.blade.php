<select name="{{ $input['name'] }}" class="form-control mr-2 {{ isset($input['class']) ? $input['class'] : '' }}"
    id="{{ $input['id'] ?? $input['name'] }}" {{ isset($input['required']) ? 'required' : '' }}
    style="width: {{ isset($input['width']) ? $input['width'] : '150px' }}">

    @if (!isset($input['hidePlaceholder']))
        <option value="">
            {{ '--Select ' . formatter($input['name']) . ' --' }}
        </option>
    @endif

    @foreach ($input['options'] as $key => $value)
        <option value="{{ $key }}" {{ $key === (int) $input['value'] ? 'selected' : '' }}>
            {{ $value }}</option>
    @endforeach
</select>
@error($input['name'])
    <span class="text text-danger">{{ $message }}</span>
@enderror
