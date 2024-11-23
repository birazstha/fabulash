@if(isset($input['anchor']) && $input['anchor'] === true)
<a href="{{ route($input['link']['route'],$input['link']['params']) }}"
    class="btn {{ 'btn-'.$input['btnType'] }} {{ isset($input['btnSize'] ) ? 'btn-'.$input['btnSize']  :'btn-sm' }} {{  isset($input['disabled']) && $input['disabled'] === true ? 'disabled':'' }}">
    <i class="{{ $input['icon'] ?? '' }}"></i>&nbsp;{{
    $input['title'] ?? '' }}
</a>
@else
<button type="button"
    class="btn {{ $input['btnType'] }} {{ isset($input['btnSize'] ) ? 'btn-'.$input['btnSize']  :'btn-sm' }}">
    <i class="{{ $input['icon'] ?? '' }}"></i> {{
    $input['title'] ?? '' }}
</button>
@endif