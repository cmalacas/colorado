@php 

$hideButton = isset($hideButton) ? $hideButton : false;

@endphp
<div class="modal" tabindex="-1" role="dialog" id="{{ $id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! $form !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">{{ $button }}</button>
        @if ( $hideButton )
          <button type="button" class="btn btn-success">{{ $hideButton }}</button>        
          <button type="button" class="btn btn-danger">Delete</button>
        @endif
      </div>
    </div>
  </div>
</div>