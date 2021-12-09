<div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-8">
        <label class="{{ $class }}"> <input type="checkbox" {{$value == '1' ? 'checked' : ''}} name="{{ $name }}" placeholder="{{ $placeholder }}" /> {{ $placeholder}}</label> 
    </div>
</div>