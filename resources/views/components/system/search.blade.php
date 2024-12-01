<input type="{{ $input['type'] ?? 'text' }}" name="{{ $input['name'] ?? '' }}"
    class="form-control float-right mr-2{{ $input['class'] ?? '' }}"
    placeholder="{{ isset($input['placeholder']) ? $input['placeholder'] : 'Enter ' . formatter($input['name']) }}"
    value="{{ $input['value'] ?? '' }}" id="{{ $input['id'] ?? $input['name'] }}" autocomplete="off" style="width: 160px">
