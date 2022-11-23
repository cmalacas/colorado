@php

$tabindex = isset($tabindex) ? $tabindex : 0;

@endphp

<div class="form-group row">
    <label class="col-md-12">{{ $placeholder }}</label>
    <div class="col-md-12">
        <textarea tabindex="{{ $tabindex }}" type="text" name="{{ $name }}" class="{{ $class }}">{{ $value }}</textarea>
    </div>
</div>