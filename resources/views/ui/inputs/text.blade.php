@php

$value = isset($value) ? $value : '';
$withLabel = isset($withLabel) ? $withLabel : true;
$readonly = isset($readonly) ? $readonly : false;
$help = isset($help) ? $help : false;
$required = isset($required) ? $required : false;
$tabindex = isset($tabindex) ? $tabindex : 0;
@endphp
<div class="form-group row">
    @if($withLabel)
        <label class="col-md-3 text-right">{{ $placeholder }}
            @if ($help)
            <small class="d-block">{{ $help }}</small>
            @endif
        </label>
    @endif    
    <div class="@if($withLabel) col-md-8 @else col-md-12 @endif">
        <input tabindex="{{ $tabindex }}" type="text" name="{{ $name }}" class="{{ $class }}" @if($required) required @endif autocomplete="off"  value="{{ $value }}" @if($readonly) readonly @endif />
    </div>
</div>