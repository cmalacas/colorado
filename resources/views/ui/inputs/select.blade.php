@php

$options = isset($options) ? $options : [];
$value = isset($value) ? $value : '';
$withLabel = isset($withLabel) ? $withLabel : true;

$plus = isset($plus) ? $plus : false;

$default = isset($default) ? $default : false;

$tabindex = isset($tabindex) ? $tabindex : 0;

$onChange = isset( $onChange ) ? $onChange : false;

@endphp
<div class="form-group row">
    @if ($withLabel)
        <label class="col-md-3 text-right">{{ $placeholder }}</label>
    @endif    
    <div class="@if($withLabel) col-md-8 @else col-md-12 @endif">
        <select tabindex="{{ $tabindex }}" {{ $onChange ? 'onChange=' . $onChange : '' }} name="{{ $name }}" class="{{ $class }}" placeholder="{{ $placeholder }}">
       
            <option value="0"></option>
       
            @foreach($options as $option)
            <option value="{{ $option }}" @if($value == $option) selected @endif >{{ $option }}</option>
            @endforeach
        </select>

        @if ($plus)
        {!! $plus !!}
        @endif

    </div>
</div>