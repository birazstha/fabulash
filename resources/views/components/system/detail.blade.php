<div>
    <div class="row">
        <div class="col-sm-3">
            <label for="name">{{ isset($input['label']) ? $input['label'] : '' }}</label>
        </div>
        <div class="col-sm-9">
            <p>: &nbsp; &nbsp;{{ isset($input['value']) ? $input['value'] : '' }}</p>
        </div>
    </div>
</div>
