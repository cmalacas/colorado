@php

$tabindex = isset($tabindex) ? $tabindex : 0;

@endphp

<div class="form-group row">
    <div class="col-md-12">
        <span style="display:inline-block; min-width:300px; max-width:100%; min-height: 40px;" role="textbox" contenteditable tabindex="{{ $tabindex }}" type="text" class="{{ $class }}">{{ $value }}</span>
        <textarea style="display:none" name="{{ $name }}"></textarea>
    </div>
</div>