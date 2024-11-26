<form id="updateForm" action="{{ route('menus.store') }}" method="POST" novalidate>
    @csrf
    <div class="form-group row">
        {{-- Title --}}
        <x-system.input :input="[
            'name' => 'title_eng',
            'placeholder' => 'Title',
            'label' => 'Title',
            'required' => true,
            'value' => $item->title_eng ?? old('title_eng'),
            'autofocus' => true,
        ]" />

        {{-- Rank --}}
        <x-system.input :input="[
            'name' => 'rank',
            'label' => 'Rank',
            'type' => 'number',
            'value' => $item->rank ?? old('rank'),
            'autofocus' => true,
        ]" />

        {{-- Href --}}
        <x-system.input :input="[
            'name' => 'href',
            'label' => 'Href',
            'value' => $item->href ?? old('href'),
            'autofocus' => true,
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
