<input type="{{ $input['type'] ?? 'text' }}" name="{{ $input['name'] ?? '' }}" class="form-control float-right mr-2"
    placeholder="{{ $input['placeholder'] ?? '' }}" value="{{ Request::input('keyword') }}"
    id="{{ $input['id'] ?? $input['name'] }}" autocomplete="off">
