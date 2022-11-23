@extends('layouts.plane')

@section('title', 'Production Orders')

@section('content')
<style>
.single-nav {
    display: flex;
    justify-content: flex-start;
}

.single-nav a {
    display:inline-block;
    max-height: 36px;
}

.single-nav .form-group {
    min-width: 200px;
}

.single-nav .form-group label {
    display: none;
}

.single-nav .form-group .col-md-8 {
    width: 80%;
    margin: 0 auto;
}

.form-control.alert-danger {
  margin-bottom: 0;
  padding:0.375rem 0.75rem;
}
</style>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Production Orders - Edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Production Orders</li>
                </ol>
            
            </div>
        </div>
    </div>

    <form method="POST" autocomplete="off" action="/production-orders/{{ $data['id'] }}" id="productOrderForm">

        @csrf
        @method('PUT')

        <input type="hidden" name="tab" value={{ $tab }}>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    @if (session('message'))

                        <div class="p-2 bg-success text-light">
                            {{session('message')}}
                        </div>

                    @endif

                    <div class="row">

                        <div class="col-md-3" style="display: flex; justify-content: flex-start">

                            {!! $previous !!} 

                            <select name="select" class="form-control">
                                <option value="0"></option>
                                @foreach($options as $option)
                                <option value="{{ $option }}" @if($data->id == $option) selected @endif >{{ $option }}</option>
                                @endforeach
                            </select>
                            
                            
                            {!! $next !!}

                        </div>

                        <div class="col-md-2" style="padding-top:10px">

                            @component('ui.inputs.checkbox', 
                                ['name' => 'Invoiced', 
                                'class' => 'form-control', 
                                'placeholder' => 'Invoiced',
                                'tabindex' => 19,
                                'value' => isset($data['Invoiced']) ? $data['Invoiced'] : ''
                                ])
                            @endcomponent

                        </div>

                        <div class="col-md-4" style="padding-top:10px">

                            @component('ui.inputs.text', 
                                ['name' => 'id', 
                                'class' => 'form-control', 
                                'placeholder' => 'Prod Order',
                                'readonly' => 'true',
                                'tabindex' => 0,
                                'value' => isset($data['id']) ? $data['id'] : 0
                                ]),
                            @endcomponent

                        </div>

                        <div class="col-md-3">

                            <div class="buttons text-right p-2">
                                
                                <a data-toggle="tooltip" title="Create new production order" href="/production-orders/create" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                
                                <button data-toggle="tooltip" title="Save" data-action="save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                                
                                <button data-toggle="tooltip" title="Print" data-action="print" class="btn btn-info"><i class="fa fa-print"></i></button>

                                <button data-toggle="tooltip" title="Cancel" data-action="cancel" class="btn"><i class="fa fa-reply"></i></button>
                                
                                <a data-toggle="tooltip" title="Duplicate this production order" href="/production-orders/{{ $data->id }}/copy" class="btn btn-success"><i class="fa fa-copy"></i></a>

                                <a data-toggle='tooltip' title="Advanced Search" href="#" class="btn btn-primary po-search-button" title="Advanced Search"><i class="fa fa-search"></i></a>
                        

                            </div>
                        </div>

                    </div>        

                    <ul class="nav nav-tabs" role="tablist"> 
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="converting-tab" data-toggle="tab" href="#converting" role="tab" aria-controls="converting" aria-selected="false">Converting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cutting-tab" data-toggle="tab" href="#cutting" role="tab" aria-controls="cutting" aria-selected="false">Cutting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="printing-tab" data-toggle="tab" href="#printing" role="tab" aria-controls="printing" aria-selected="false">Printing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="packaging-tab" data-toggle="tab" href="#packaging" role="tab" aria-controls="packaging" aria-selected="false">Packaging</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">Shipping</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="packing-tab" data-toggle="tab" href="#packing" role="tab" aria-controls="packing" aria-selected="false">Packing Slip</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="related-tab" data-toggle="tab" href="#related" role="tab" aria-controls="related" aria-selected="false">Related Purchase Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="related" aria-selected="false">Documents</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                        </li> -->                           
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                           
                            @include('production-orders.edit-general')
                        </div>
                        <div class="tab-pane fade" id="converting" role="tabpanel" aria-labelledby="converting-tab">
                            <div class="p-4" style="max-width:1200px">
                                @include('production-orders.edit-converting')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cutting" role="tabpanel" aria-labelledby="cutting-tab">
                            <div class="p-4">
                                @include('production-orders.edit-cutting')
                                </div>    
                        </div>
                        <div class="tab-pane fade" id="printing" role="tabpanel" aria-labelledby="printing-tab">
                            <div class="p-4">
                                @include('production-orders.edit-printing')
                                </div>
                        </div>
                        <div class="tab-pane fade" id="packaging" role="tabpanel" aria-labelledby="packaging-tab">
                            <div class="p-4">
                                @include('production-orders.edit-packaging')
                                </div>
                        </div>
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <div class="p-4">
                                @include('production-orders.edit-shipping')
                                </div>
                        </div>
                        <div class="tab-pane fade" id="packing" role="tabpanel" aria-labelledby="packking-tab">
                            <div class="p-4"> 
                                @include('production-orders.edit-packing')
                                </div>
                        </div>
                        <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="related-tab">
                            <div class="p-4">
                                @include('production-orders.edit-related')
                                </div>
                        </div>

                        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="p-4">
                                  @include('production-orders.edit-documents')
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <div class="p-4">
                                @include('production-orders.edit-notes')
                                </div>

                        </div> -->
                    </div>

                    <div class="text-right p-2">
                        <button onClick="return javascript:productOrderForm.submit();"  class="btn btn-primary save-btn">Save</button>
                    </div>
                    
                </div>
            
            </div>

        </div>

    </div>

    </form>

    <div class="toast" id="production-toast" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <strong class="mr-auto"><i class="fa fa-grav"></i> Success!</strong>
            
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <div></div>
        </div>
    </div>

@endsection

@section('modal')

@component('ui.customer-modal-table',
[
    'id' => 'customer-table-modal',
    'title' => 'Customers',
    'table' => '',
    'button' => 'Add Customer'
])
@endcomponent

@component('ui.modal-table',
[
    'id' => 'contact-table-modal',
    'title' => 'Contacts',
    'table' => '',
    'button' => ''
])
@endcomponent

@component('ui.modal-form',
[
    'id' => 'add-customer-modal',
    'title' => 'Add Customer',
    'form' => $addCustomer,
    'button' => 'Save'
])
@endcomponent

@component('ui.modal-form',
[
    'id' => 'edit-customer-modal',
    'title' => 'Edit Customer',
    'form' => $addCustomer,
    'button' => 'Save',
    'hideButton' => 'Hide Customer'
])
@endcomponent

@component('ui.modal-form',
[
    'id' => 'add-contact-modal',
    'title' => 'Add Contact',
    'form' => $addContact,
    'button' => 'Save'
])
@endcomponent

@component('ui.modal-form',
[
    'id' => 'edit-contact-modal',
    'title' => 'Edit Contact',
    'form' => $addContact,
    'button' => 'Save'
])
@endcomponent

@component('ui.modal-table',
[
    'id' => 'email-packing-slip',
    'title' => 'Email Packing Slip',
    'table' => $packingSlip,
    'button' => 'Send'
])
@endcomponent

@component('ui.modal-form', [
    'id' => 'production-orders-search-modal',
    'title' => 'Advanced Search',
    'form' => $search,
    'button' => 'Search'
])
@endcomponent



@endsection

@section('script')

<script>

function phone_formatting(ele,restore) {
  var new_number,
      selection_start = ele.selectionStart,
      selection_end = ele.selectionEnd,
      number = ele.value.replace(/\D/g,'');
  
  
  if (number.length > 2) {
  
    new_number = number.substring(0,3) + '-';
    if (number.length === 4 || number.length === 5) {
  
      new_number += number.substr(3);
    }
    else if (number.length > 5) {
  
      new_number += number.substring(3,6) + '-';
    }
    if (number.length > 6) {  
      new_number += number.substring(6);
    }
  }
  else {
    new_number = number;
  }
  
  ele.value =  (new_number.length > 12) ? new_number.substring(0,12) : new_number;
  
  document.getElementById('msg').innerHTML='<p>Selection is: ' + selection_end + ' and length is: ' + new_number.length + '</p>';
  
  if (new_number.slice(-1) === '-' && restore === false
      && (new_number.length === 8 && selection_end === 7)
          || (new_number.length === 4 && selection_end === 3)) {
      selection_start = new_number.length;
      selection_end = new_number.length;
  }
  else if (restore === 'revert') {
    selection_start--;
    selection_end--;
  }
  ele.setSelectionRange(selection_start, selection_end);

}
  
function phone_number_check(field,e) {
  var key_code = e.keyCode,
      key_string = String.fromCharCode(key_code),
      press_delete = false,
      dash_key = 189,
      delete_key = [8,46],
      direction_key = [33,34,35,36,37,38,39,40],
      selection_end = field.selectionEnd;
  
  // delete key was pressed
  if (delete_key.indexOf(key_code) > -1) {
    press_delete = true;
  }
  
  // only force formatting is a number or delete key was pressed
  if (key_string.match(/^\d+$/) || press_delete) {
    phone_formatting(field,press_delete);
  }
  // do nothing for direction keys, keep their default actions
  else if(direction_key.indexOf(key_code) > -1) {
    // do nothing
  }
  else if(dash_key === key_code) {
    if (selection_end === field.value.length) {
      field.value = field.value.slice(0,-1)
    }
    else {
      field.value = field.value.substring(0,(selection_end - 1)) + field.value.substr(selection_end)
      field.selectionEnd = selection_end - 1;
    }
  }
  // all other non numerical key presses, remove their value
  else {
    e.preventDefault();
//    field.value = field.value.replace(/[^0-9\-]/g,'')
    phone_formatting(field,'revert');
  }

}



$(document).ready(function() {

    const tab = $('input[name=tab]').val();

    $('input[type=text]').on('click', function() {
      this.select();
    })

    let ShippingDetailsNo = 1;

    $('.nav-tabs .nav-item a').on('click', function() {

      if ($(this).attr('href') === '#packing') {
        
        $('.save-btn').hide();

      } else {

        $('.save-btn').show();

      }

      $('input[name=tab]').val($(this).attr('id'));

      $.ajax( {
        url: '/production-orders'
      })

    });

    $(`a#${tab}`).trigger('click');

    $('select[name=CustomerId]').select2();

    $('.date').datepicker({dateFormat: "mm-dd-yy"});    

    $('.single-nav select').change(function() {
        window.location = '/production-orders/' + $(this).val() + '/edit'
    });

    $('.buttons button').on('click', function() {
        var action = $(this).data('action');

        if (action === 'save') {
            return $('#produtOrderForm').submit();
        }

        if (action === 'cancel') {
            window.location = '/production-orders/';
        }

        if (action === 'print') {
            window.open("/production-orders/{{ $data['id'] }}/print");
        }

        return false;
    });

    $('input[name=QtyNeeded], input[name=OversAllow]').on('keyup', function() {
        var qty = $('input[name=QtyNeeded]').val();
        var over = $('input[name=OversAllow]').val();
        var total = parseFloat(qty) + (parseFloat(qty) * over / 100);

        $('input[name=Total]').val(total);

    });

    $('input[name=Phone], input[name=Mobile], input[name=Fax], input[name=Alt], input.phone').on('keyup', function(e) {
        phone_number_check(this, e);
    });

    $('input[name=WindowSz1], input[name=WindowSz2], input[name=WindowSz3]').autocomplete({
        source: {!! $windowSizes !!}
    });    

    $.ajax( {
        url: `/production-orders/{{ $data['id'] }}/packing`,
        type: 'get',
        dataType: 'json',
        success: (data) => {
            
            $('.shipping-details-table tbody').html(data.html);

            ShippingDetailsNo = data.results.length + 1;

            const ColoEnvPO = $('select[name=select] option:selected').val();

            $('.shipping-details-table tfoot > tr > td:first-child').html(`${ColoEnvPO} - ${ShippingDetailsNo}`);
            $('.shipping-details-table tfoot #PackingNo').val(ShippingDetailsNo);

            $('[data-toggle="tooltip"]').tooltip()

        }
    });
    
})

</script>

<script>

$(document).on('click', '.shipping-details-table tfoot a.btn', function() {

    const row = $(this).closest('tr');
    
    let valid = true;

    const date = $('input.date', row).val();

    if (date === '') {
      valid = false;
      $('input.date', row).addClass('alert alert-danger').after('<div class="text-danger">Enter valid date</div>')
    }

    if (valid) {

      const details = $('span', row).html();

      $('textarea', row).val(details);
      $('span', row).html('');

      const data = $('input, select, textarea', row); 

      $('input', row).removeClass('alert').removeClass('alert-danger');
      $('div.text-danger').remove();

      $.ajax( {
          url: '/packing',
          data: data,
          type: 'post',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: 'json',
          success: (data) => {
              $('.shipping-details-table tbody').html(data.html);
              const ShippingDetailsNo = data.results.length + 1;
              const dataId = {{ $data->id }}            
              $('.shipping-details-table tfoot input[type=text]').val('')
              $('.shipping-details-table tfoot select').val('')
              $('.shipping-details-table tfoot textarea').val('');
              $('.shipping-details-table tfoot > tr > td:first-child').html(`${dataId}-${ShippingDetailsNo}`);
              $('.shipping-details-table tfoot #PackingNo').val(ShippingDetailsNo);
          }
      })
    }

    return false;
});

$(document).on('click', '.shipping-details-table tbody a.btn', function() {

    const id = $(this).data('id');
    const action = $(this).data('action');
    const row = $(this).closest('tr');    

    if (action == 'edit') {

        $.ajax( {
            url: `/packing/${id}/edit`,
            type: 'get',
            dataType: 'json',
            success: (data) => {
                
                $(row).html(data.html);

                $('.shipping-details-table .date').datepicker({dateFormat: "mm-dd-yy"});    
            }
        })
    }

    if (action == 'delete' && confirm("Are you sure you want to delete this?")) {
        $.ajax( {
            url: `/packing/${id}`,
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: () => {               
                $(row).remove();
            }
        })
    }

    if (action == 'update') {

      let valid = true;

      const date = $('input.date', row).val();

      if (date === '') {
        valid = false;
        $('input.date', row).addClass('alert alert-danger').after('<div class="text-danger">Enter valid date</div>');
      }

      if (valid) {

          const details = $('span', row).html();

          $('textarea', row).val(details);

          const data = $('input, select, textarea', row);

          $.ajax( {
              url: `/packing/${id}`,
              type: 'PATCH',
              data: data,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              dataType: 'json',
              success: (data) => {                
                  $('.shipping-details-table tbody').html(data.html);
              }
          })
      }
    }

    if (action == 'print') {

      const printWin = window.open(`/packing/${id}/print`, 'packing', 'height=800 widt=800 scrolls resizable');

      printWin.focus();

    }

    if (action == 'email') {

      $.ajax(
        {
          url: `/packing/${id}/`,
          type: 'get',
          dataType: 'json',
          success: (data) => {
            
            $('#email-packing-slip .modal-body').html(data.table);
            $('#email-packing-slip').modal('show');

            emailPackingSlip();

          }
        }
      ) 
    }

    return false;
});


</script>

<script>
  $( function() {
    var doubleDies = {!! $dies !!};
 
    $( "input[name=WindowDoubleDie]" ).autocomplete({
      minLength: 0,
      source: doubleDies,
      focus: function( event, ui ) {
        $( "input[name=WindowDoubleDie]" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "input[name=WindowDoubleDie" ).val( ui.item.label );
        $( "input[name=WindowSz1]" ).val( ui.item.WindowSize1 );
        $( "input[name=WindowSz2]" ).val( ui.item.WindowSize2 );
        $( "input[name=WindowPos1]" ).val( ui.item.WindowPosition1 );
        $( "input[name=WindowPos2]" ).val( ui.item.WindowPosition2 );

        //$size = ui.item.EnvelopeSize.split(" x ");

        //console.log('size', $size, ui.item);

        //$( 'input[name=SizeDimension1]' ).val($size[0]);
        //$( 'input[name=SizeDimension2]' ).val($size[1]);
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      //console.log('double die', doubleDies, item);

      return $( "<li></li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };
  } );
  </script>

<script>
  var strMatcher = function(strs) {
  
      return function findMatches(q, cb) {
    
          var matches, substringRegex;

          matches = [];

          substrRegex = new RegExp(q, 'i');

          $.each(strs, function(i, str) {
            /* if (substrRegex.test(str)) {
              matches.push(str);
            }*/
            matches.push(str);
          });

          cb(matches);
      };
    }   ;


  $( function() {
    var unitFigure = {!! $unitFigures !!};
 
      $( "input[name=UnitFigure]" ).typeahead({
          minLength: 0
        },
        {
          name: 'unitFigure',
          source: strMatcher(unitFigure)
        }
      )
    
    
  } ); 
  </script>

<script>
  $( function() {
    var locations = {!! $locations !!};

    var foldingSchedule = ['RA-1', 'RA-2', 'RA-3', 'WR-1', 'WR-2', 'WR-3', 'MOW', 'MO', 'SO'];
 
    $( "input[name=Location]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(locations)
        }
      );

    $( "input[name=FoldingScheduleStatus]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(foldingSchedule)
        }
      )


    } );   
</script>

<script>
  $( function() {
    var machines = {!! $machines !!};
 
    $( "input[name=Machine1]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      );
    
    var printing = {!! $printing !!}

    $( "input[name=Printing]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(printing)
        }
      );  

    var InsideTintStyle = {!! $styles !!}

    $('input[name=InsideTintStyle]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(InsideTintStyle)
        }
      );  

    var openPolies = {!! json_encode($openPolies) !!}

    $('input[name=OpenPolyWinPos1]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(openPolies)
        }
      );

    $('input[name=OpenPolyWinPos2]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(openPolies)
        }
      );

    $('input[name=OpenPolyWinPos3]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(openPolies)
        }
      );  

    var Sides = [1,2];

    $('input[name=Sides]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(Sides)
        }
      );  

    var BoxSize = {!! $boxSizes !!};

    var CtnSize = {!! $ctnSizes !!};

    $('input[name=BulkBoxSz]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(CtnSize)
        }
    );  

    

    $('input[name=FoldingBoxSz]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(BoxSize)
        }
    );  

    
    /* autocomplete({
      minLength: 0,
      source: machines,
      focus: function( event, ui ) {
        $( "input[name=Machine1]" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      //console.log('double die', doubleDies, item);

      return $( "<li></li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };*/
  


  $( "input[name=Machine2]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      );
  


  $( "input[name=Machine3]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      );
 


  $( "input[name=Machine4]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      );
  

  $( "input[name=Machine5]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      )
      ;
 

  $( "input[name=Machine6]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(machines)
        }
      );
  });
  </script>


<script>
  $( function() {
    var descriptions = {!! $descriptions !!};
 
    $( "input[name=Description]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(descriptions)
        }
      );
  } );
  </script>


<script>
  $( function() {
    var seals = {!! $seals !!};
 
    $( "input[name=SealFlap]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(seals)
        }
      );

    /* $( "input[name=SealFlapSz]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(seals)
        }
      ); */



  } );
  </script>

<script>
  $( function() {
    var gums = {!! $gums !!};
 
    $( "input[name=GumType]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(gums)
        }
      );

  });
</script>



<script>
  /* $( function() {
    var diagonalSeams = {!! $diagonalSeams !!};
 
    $( "input[name=OutDiagonal]" ).autocomplete({
      minLength: 0,
      source: diagonalSeams,
      focus: function( event, ui ) {
        $( "input[name=OutDiagonal]" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      //console.log('double die', doubleDies, item);

      return $( "<li></li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };    

  }); */
</script>  

<script>
  /*$( function() {
    var openEnds = {!! $openEnds !!};
 
    $( "input[name=OutCatalogEnd]" ).autocomplete({
      minLength: 0,
      source: openEnds,
      focus: function( event, ui ) {
        $( "input[name=OutCatalogEnd]" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      //console.log('double die', doubleDies, item);

      return $( "<li></li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };    

  });*/
  </script>

<script>
  /*$( function() {
    var openSides = {!! $openSides !!};
 
    $( "input[name=OutCatalogSide]" ).autocomplete({
      minLength: 0,
      source: openSides,
      focus: function( event, ui ) {
        $( "input[name=OutCatalogSide]" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      //console.log('double die', doubleDies, item);

      return $( "<li></li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };    

  });*/
  </script>

<script>
  $( function() {
    var coloStocks = {!! $coloStocks !!};
 
    $( "input[name=ColoEnvStock]" ).typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'unitFigure',
          source: strMatcher(coloStocks)
        }
      );

  });
</script>

<script>  
    /* const WindowPosition = [
            '5/16 x 1 1/4 - Oval',
            '3/8 x 9/16',
            '3/8 x 1 5/8',
            '3/8 x 2 1/2 oval',
            '3/8 x 2 5/8 oval',
            '3/8 x 3 1 is oval',
            '3/8 x 4 oval',
            '3/8 x 8 1/2 - perf bar',
            '7/16 x 3 7/8',
            '1/2 X 1 3/16',
            '1/2 X 1 1/4',
            '1/2 X 2',
            '1/2 X 2 1/4',
            '1/2 X 2 3/8',
            '1/2 X 2 1/2',
            '1/2 x 2 3/4 ',
            '1/2 x 2 13/16 ',
            '1/2 x 3 (3)',
            '1/2 x 3 3/8 oval',
            '1/2 x 3 1/2',
            '1/2 x 3 3/4',
            '1/2 x 4',
            '1/2 x 4 1/4 oval',
            '1/2 x 4 1/8',
            '1/2 x 4 3/16',
            '1/2 x 4 3/8 ',
            '1/2 x 5 3/16',
            '9/16 x 2 1/8',
            '9/16 x 2 9/16',
            '9/16 x 2 15/16',
            '9/16 x 3 7/8 ',
            '9/16 x 4',
            '9/16 x 4 1/4',
            '5/8 X 7/8',
            '5/8 X 2 1/8',
            '5/8 X 2 3/8',
            '5/8 X 2 1/2',
            '5/8 x 2 3/4',
            '5/8 x 2 7/8',
            '5/8 X 3 ',
            '5/8 X 3 1/2',
            '5/8 x 3 5/8',
            '5/8 x  3 3/4',
            '5/8 x 4',
            '5/8 x 4 1/4  oval',
            '5/8 x 4 1/2  ',
            '11/16 x 2 3/16',
            '11/16 x 2 1/4',
            '11/16 x 2 3/4',
            '11/16 x 3 3/16',
            '11/16 x 4',
            '3/4 x 1',
            '3/4 x 1 7/8 ',
            '3/4 x 1 15/16',
            '3/4 x 2 1/4   ',
            '3/4 x 2 5/16',
            '3/4 x 2 7/16',
            '3/4 x 2 5/8',
            '3/4 x 2 11/16',
            '3/4 x 2 3/4',
            '3/4 x 3',
            '3/4 x 3 1/2',
            '3/4 x 3 5/8 ',
            '3/4 x 3 3/4',
            '3/4 x 3 7/8',
            '3/4 x 4',
            '3/4 x 4 1/8',
            '3/4 x 4 1/2  (2) 1 is oval',
            '3/4 X 4 7/8  oval',
            '3/4 X 8 5/16',
            '13/16 x 2 3/16',
            '13/16 x 2 13/16',
            '13/16 x 3',
            '13/16 x 3 1/16',
            '13/16 x 3 1/4',
            '7/8 x 2 3/8',
            '7/8 X 2 1/2',
            '7/8 x 2 5/8',
            '7/8 x 2 3/4',
            '7/8 x 3',
            '7/8 x 3 1/8',
            '7/8 X 3 1/4',
            '7/8 x 3 1/2',
            '7/8 x 3 3/4',
            '7/8 x 3 7/8',
            '7/8 x 4',
            '7/8 x 4 1/4',
            '7/8 x 4 3/8',
            '7/8 x 4 1/2',
            '7/8 x 4 5/8',
            '15/16 x 2 5/8',
            '15/16 x 3 1/4',
            '15/16 x 3 5/16',
            '15/16 x 3 1/2',
            '15/16 x 3 7/8',
            '15/16 x 4',
            '1" Circle Die',
            '1 X 3/4',
            '1 X 2',
            '1 X 2 1/4',
            '1 X 2 3/8',
            '1 X 2 1/2',
            '1 X 2 5/8',
            '1 X 2 3/4',
            '1 X 2 13/16',
            '1 X 3',
            '1 X 3 1/8',
            '1 X 3 3/16',
            '1 X 3 1/4',
            '1 X 3 3/8',
            '1 X 3 7/16',
            '1 X 3 7/16 Pistol Style',
            '1 X 3 1/2',
            '1 X 3 5/8',
            '1 X 3 3/4',
            '1 X 3 7/8',
            '1 X 4',
            '1 X 4 1/16',
            '1 X 4 1/8',
            '1 X 4 1/4',
            '1 X 4 3/8',
            '1 X 4 1/2',
            '1 X 5',
            '1 X 5 3/8',
            '1 X 7 1/4',
            '1 1/16 x 2 9/16',
            '1 1/16 x 2 11/16',
            '1 1/16 x 2 3/4 ',
            '1 1/16 x 2 7/8',
            '1 1/16 x 3 1/4',
            '1 1/16 x 3 1/2',
            '1 1/16 x 3 7/8',
            '1 1/16 x 4 7/16',
            '1 1/16 x 4 1/2',
            '1 1/8 x 2 1/2',
            '1 1/8 x 2 5/8',
            '1 1/8 x 2 3/4',
            '1 1/8 x 3',
            '1 1/8 x 3 1/8',
            '1 1/8 X 3 1/4',
            '1 1/8 x 3 5/16',
            '1 1/8 x 3 3/8',
            '1 1/8 X 3 1/2',
            '1 1/8 X 3 5/8',
            '1 1/8 X 3 11/16',
            '1 1/8 X 3 3/4',
            '1 1/8 X 3 7/8',
            '1 1/8 X 3 7/8 Pistol Die',
            '1 1/8 X 4',
            '1 1/8 X 4 1/8',
            '1 1/8 X 4 3/8',
            '1 1/8 X 4 1/4',
            '1 1/8 X 4 5/16',
            '1 1/8 X 4 1/2',
            '1 1/8 X 4 5/8',
            '1 1/8 X 4 3/4',
            '1 1/8 x 4 7/8',
            '1 1/8 X 5 1/4',
            '1 1/8 x 6 1/4',
            '1 3/16 X 2 5/8',
            '1 3/16 X 2 11/16',
            '1 3/16 x 3 1/4',
            '1 3/16 x 3 3/8',
            '1 3/16 X 3 1/2',
            '1 3/16 x 3 5/8',
            '1 3/16 x 3 7/8',
            '1 3/16 x 4',
            '1 3/16 x 4 1/4',
            '1 3/16 x 5',
            '1 3/16 x 5 5/8',
            '1 3/16 X 2 5/8',
            '1 3/16 X 2 11/16',
            '1 3/16 x 3 1/4',
            '1 3/16 x 3 3/8',
            '1 3/16 X 3 1/2',
            '1 3/16 x 3 5/8',
            '1 3/16 x 3 7/8',
            '1 3/16 x 4',
            '1 3/16 x 4 1/4',
            '1 3/16 x 5',
            '1 3/16 x 5 5/8',
            '1 1/4 x 2',
            '1 1/4 X 2 9/16',
            '1 1/4 X 2 3/8',
            '1 1/4 X 2 3/4',
            '1 1/4 x 2 7/8',
            '1 1/4 X 3 (4)',
            '1 1/4 X 3 1/8',
            '1 1/4 X 3 1/4',
            '1 1/4 X 3 3/8',
            '1 1/4 X 3 1/2',
            '1 1/4 X 3 3/4 + 1 Pistol',
            '1 1/4 X 3 7/8',
            '1 1/4 X 4',
            '1 1/4 x 4 1/8',
            '1 1/4 X 4 1/4',
            '1 1/4 X 4 3/8',
            '1 1/4 X 4 1/2',
            '1 1/4 X 4 5/8',
            '1 1/4 X 4 3/4',
            '1 1/4 X 4 7/8',
            '1 1/4 x 5',
            '1 1/4 X 5 1/4',
            '1 1/4 X 5 3/8',
            '1 1/4 X 5 3/8 Pistol',
            '1 1/4 X 5 1/2',
            '1 1/4 x 7 - on a saddle',
            '1 5/16 x 2 1/2',
            '1 5/16 x 2 5/8',
            '1 5/16 x 4',
            '1 5/16 x 4 1/2',
            '1 5/16 x 5 1/8',
            '1 3/8 X 2 3/4',
            '1 3/8 X 3 1/8',
            '1 3/8 X 3 1/4',
            '1 3/8 X 3 3/8',
            '1 3/8 X 3 7/16',
            '1 3/8 X 3 1/2',
            '1 3/8 X 3 9/16',
            '1 3/8 X 3 5/8',
            '1 3/8 X 3 3/4',
            '1 3/8 X 3 7/8',
            '1 3/8 X 4',
            '1 3/8 X 4 1/8',
            '1 3/8 X 4 1/4',
            '1 3/8 X 4 1/2',
            '1 3/8 X 4 1/2 Pull tab perf',
            '1 3/8 X 4 5/8',
            '1 3/8 x 4 3/4 ',
            '1 3/8 X 5 1/8',
            '1 3/8 X 5 3/4',
            '1 3/8 X 6 5/16',
            '1 7/16 x 3 1/2',
            '1 7/16 x 3 9/16',
            '1 7/16 x 3 11/16',
            '1 7/16 x 4',
            '1 7/16 x 4 1/8',
            '1 7/16 x 4 1/4  - Pistol',
            '1 1/2 x 1 3/4',
            '1 1/2 x 2 1/2',
            '1 1/2 x 2 7/8 ',
            '1 1/2 x 3',
            '1 1/2 x 3 1/8',
            '1 1/2 x 3 1/4',
            '1 1/2 x 3 1/2 OVAL',
            '1 1/2 X 3 1/2',
            '1 1/2 X 3 5/8 (regular)',
            '1 1/2 X 3 3/4',
            '1 1/2 X 3 7/8',
            '1 1/2 X 4',
            '1 1/2 X 4 1/8',
            '1 1/2 X 4 1/4',
            '1 1/2 X 4 1/2',
            '1 1/2 X 4 5/8',
            '1 1/2 X 4 7/8',
            '1 1/2 X 5',
            '1 1/2 X 5 1/4 (pistol) - on saddle',
            '1 1/2 X 5 3/8',
            '1 1/2 x 5 7/8',
            '1 1/2 x 6 1/2 - slitter',
            '1 9/16 x 3 3/8 pistol style',
            '1 9/16 x 4',
            '1 9/16 x 4 3/8',
            '1 5/8 x 1 5/8',
            '1 5/8 x 2 1/2',
            '1 5/8 X 3 5/8',
            '1 5/8 X 3 7/8',
            '1 5/8 X 4',
            '1 5/8 X 4 1/8',
            '1 5/8 X 4 1/4',
            '1 5/8 X 4 1/2',
            '1 5/8 X 4 5/8',
            '1 5/8 x 4 3/4',
            '1 5/8 x 5 1/4',
            '1 5/8 x 6 1/4',
            '1 5/8 Circle Die',
            '1- 11/16 x 2 5/8',
            '1 3/4 X 1 3/4',
            '1 3/4 X 2 7/8',
            '1 3/4 X 3 1/8',
            '1 3/4 X 3 1/2',
            '1 3/4 X 3 3/4',
            '1 3/4 X 4 (3)',
            '1 3/4 X 4 1/8',
            '1 3/4 X 4 1/4',
            '1 3/4 X 4 3/8',
            '1 3/4 x 4 1/2',
            '1 3/4 x 4 3/4',
            '1 3/4 x 5',
            '1 3/4 x 5 1/4',
            '1 3/4 x 7 5/8',
            '1 3/4 x 8 - saddle - no slit',
            '1 13/16 x 3 1/2',
            '1 13/16 x 3 5/8',
            '1 13/16 x 4 1/2 pistol style',
            '1 13/16 x 5 5/8',
            '1 7/8 X 3 3/4',
            '1 7/8 x 4 1/4 (Henry Wurst)',
            '1 7/8 x 5 3/8  ',
            '1 7/8 x 7 3/4 - slitter',
            '1 15/16 x 4 1/2 - Printmatter',
            '2" circle',
            '2 x 1 3/8',
            '2 x 2 1/4',
            '2 x 2 3/4',
            '2 x 3',
            '2 x 3 1/2',
            '2 x 3 3/8',
            '2 X 3 3/4',
            '2 X 4',
            '2 x 4 1/4',
            '2 x 4 1/2',
            '2 x 5 3/4  Dbl Pull Perf',
            '2 x 6 3/8 w/slit Sun litho',
            'on back flap - above win',
            '2 x 6 7/8 W/sliter',
            '2 x 7 1/4 W/sliter',
            '2 1/16 X 3 5/16',
            '2 1/16 X4  - ',
            '2 1/8 x 4',
            '2 1/8 x 5 1/4',
            '2 1/4 X 2',
            '2 1/4 X 2 7/8 ',
            '2 1/4 X 3 3/8',
            '2 1/4 X 4 (2) 1 is mounted',
            '2 1/4 X 4 1/4',
            '2 1/4 X 4 1/2 - Eagle XM',
            '2 1/4 X 4 5/8',
            '2 1/4 X 5 7/8 (pistol)',
            '2 1/4 x 6',
            '2 1/4 x 6 3/4 Pistol',
            '2 1/4 x 7 3/4 - Pistol',
            '2 3/8 x 3 5/8 - Eagle 8/3/11',
            '2 3/8 x 5 5/8 Dbl Pull Perf',
            '2 1/2 x 1  3/8 Vertical',
            '2 1/2 x 3',
            '2 1/2 x 4 1/4',
            '2 1/2 x 5 3/4',
            '2 1/2 x 8 Pistol ',
            '2 9/16 x 4 1/2 PISTOL',
            '2 5/8 x 2 1/8',
            '2 5/8 x 3',
            '2 5/8 X 4',
            '2 5/8 x 6 9/16',
            '2 5/8 x 6 1/2 mounted w/slitter',
            '2 3/4 X 3 1/2',
            '2 3/4 X 4 1/2',
            '2 3/4 x 5 7/8',
            '2 3/4 X 6',
            '2 3/4 X 6 1/4 - on saddle',
            '2 7/8 X 4 1/4',
            '2 7/8 X 7 1/8 - on saddle & Slit',
            '2 7/8 X 7 7/8 - on saddle',
            '2 15/16 x 3 1/2 ',
            '3 X 2 Verticle',
            '3 x 3 5/8',
            '3 X 4',
            '3 X 4 1/4 Spliter and Mounted',
            '3 X 4 1/2 Spliter and Mounted',
            '3 1/16 X 8',
            '3 1/8 x 4 1/4 ',
            '3 3/16 Circle',
            '3 3/8 x 3 3/8 - saddle&spliter',
            '3 3/8 X 6 5/8',
            '3 1/2 X 6 11/32 purse die',
            '3 1/2 x 7',
            '3 3/4 X 4 1/2',
            '3 3/4 x 1 1/8 vertical mounted',
            '3 3/4 X 6',
            '4 x 1 3/8 vertical mounted',
            '4 x 3 1/4 - verrt mount/slit',
            '4 x 4 3/4 - Pistol Window',
            '4 3/8 x 8 1/2 - With Slitter',
            '4 1/2 x 7 1/2 - W/ Slitter',
            '4 1/2 x 7 3/4 - W/ Slitter',
            '4 3/4 X 8 w/ vert slitter',
            'Business Card Slot Die',
            '9 1/2 Perf Die (2)',
            'DOUBLE PERF MOUNT',
            '1 1/4 x 7/8 x 9',
            'The Hand Die'
    ];  

 
    $('input[name=WindowPos1]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'WindowPosition',
          source: strMatcher(WindowPosition)
        }
     );

     $('input[name=WindowPos2]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'WindowPosition',
          source: strMatcher(WindowPosition)
        }
     );

     $('input[name=WindowPos3]').typeahead(
        {
          minLength: 0,
        },
        {
          limit: 99,
          name: 'WindowPosition',
          source: strMatcher(WindowPosition)
        }
     ); */

  </script>

<script>

  const substringMatcher = function(strs) {
    
    return function findMatches(q, cb) {
        
      var matches, substringRegex;

      matches = [];

      substrRegex = new RegExp(q, 'i');

      $.each(strs, function(i, str) {

        if (substrRegex.test(str.die_size)) {
          matches.push(str);
        }
      });

      cb(matches);

    };
  };

  const dieNumberMatcher = function(strs) {
    
    return function findMatches(q, cb) {
        
      var matches, substringRegex;

      matches = [];

      substrRegex = new RegExp(q, 'i');

      $.each(strs, function(i, str) {

        if (substrRegex.test(str.die_number)) {
          matches.push(str);
        }
      });

      cb(matches);

    };
  };

  const diagonals = {!! $diagonals !!};
  const booklets = {!! $booklets !!}
  const catalogs = {!! $catalogs !!}
  const outSideSeams = {!! $outSideSeams !!}
  const adjustables = {!! $adjustables !!}
  const webs = {!! $webs !!}

  $('input[name=web_ro_die_size]').on('typeahead:selected', function(ev, suggestion) {

      const die_size = suggestion.die_size;
      const sheet_size = suggestion.sheet_size;
      const number_out = suggestion.number_out;
      const die_number = suggestion.die_number;
      const seal_flap_size = suggestion.seal_flap_size;
      const flat_size = suggestion.flat_size;

      $('input[name=web_ro_die_size]').val(die_size);
      $('input[name=web_ro_number_out]').val(number_out);
      $('input[name=web_ro_die_number]').val(die_number);
      $('input[name=web_ro_seal_flap_size]').val(seal_flap_size);
      $('input[name=web_ro_sheet_size]').val(sheet_size);
      $('input[name=web_ro_flat_size]').val(flat_size);

    });

  $('input[name=adjustable_die_size]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=adjustable_die_size]').val(die_size);
    $('input[name=adjustable_number_out]').val(number_out);
    $('input[name=adjustable_die_number]').val(die_number);
    $('input[name=adjustable_seal_flap_size]').val(seal_flap_size);
    $('input[name=adjustable_sheet_size]').val(sheet_size);
    $('input[name=adjustable_flat_size]').val(flat_size);

  });
  
  $('input[name=out_diagonal_die_size]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;

    $('input[name=out_diagonal_die_size]').val(die_size);
    $('input[name=out_diagonal_number_out]').val(number_out);
    $('input[name=out_diagonal_die_number]').val(die_number);
    $('input[name=out_diagonal_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_diagonal_sheet_size]').val(sheet_size);
    

  });

  $('input[name=out_diagonal_die_number]').on('typeahead:selected', function(ev, suggestion) {

      const die_size = suggestion.die_size;
      const sheet_size = suggestion.sheet_size;
      const number_out = suggestion.number_out;
      const die_number = suggestion.die_number;
      const seal_flap_size = suggestion.seal_flap_size;

      $('input[name=out_diagonal_die_size]').val(die_size);
      $('input[name=out_diagonal_number_out]').val(number_out);
      $('input[name=out_diagonal_die_number]').val(die_number);
      $('input[name=out_diagonal_seal_flap_size]').val(seal_flap_size);
      $('input[name=out_diagonal_sheet_size]').val(sheet_size);

  });

$('input[name=out_mo_booklet_die_size]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_mo_booklet_die_size]').val(die_size);
    $('input[name=out_mo_booklet_number_out]').val(number_out);
    $('input[name=out_mo_booklet_die_number]').val(die_number);
    $('input[name=out_mo_booklet_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_mo_booklet_sheet_size]').val(sheet_size);
    $('input[name=out_mo_booklet_flat_size]').val(flat_size);

});

$('input[name=out_mo_booklet_die_number]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_mo_booklet_die_size]').val(die_size);
    $('input[name=out_mo_booklet_number_out]').val(number_out);
    $('input[name=out_mo_booklet_die_number]').val(die_number);
    $('input[name=out_mo_booklet_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_mo_booklet_sheet_size]').val(sheet_size);
    $('input[name=out_mo_booklet_flat_size]').val(flat_size);

});

$('input[name=out_mo_catalog_die_size]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_mo_catalog_die_size]').val(die_size);
    $('input[name=out_mo_catalog_number_out]').val(number_out);
    $('input[name=out_mo_catalog_die_number]').val(die_number);
    $('input[name=out_mo_catalog_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_mo_catalog_sheet_size]').val(sheet_size);
    $('input[name=out_mo_catalog_flat_size]').val(flat_size);

});

$('input[name=out_mo_catalog_die_number]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_mo_catalog_die_size]').val(die_size);
    $('input[name=out_mo_catalog_number_out]').val(number_out);
    $('input[name=out_mo_catalog_die_number]').val(die_number);
    $('input[name=out_mo_catalog_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_mo_catalog_sheet_size]').val(sheet_size);
    $('input[name=out_mo_catalog_flat_size]').val(flat_size);

});

$('input[name=out_side_seam_die_size]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_side_seam_die_size]').val(die_size);
    $('input[name=out_side_seam_number_out]').val(number_out);
    $('input[name=out_side_seam_die_number]').val(die_number);
    $('input[name=out_side_seam_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_side_seam_sheet_size]').val(sheet_size);
    $('input[name=out_side_seam_flat_size]').val(flat_size);

});

$('input[name=out_side_seam_die_number]').on('typeahead:selected', function(ev, suggestion) {

    const die_size = suggestion.die_size;
    const sheet_size = suggestion.sheet_size;
    const number_out = suggestion.number_out;
    const die_number = suggestion.die_number;
    const seal_flap_size = suggestion.seal_flap_size;
    const flat_size = suggestion.flat_size;

    $('input[name=out_side_seam_die_size]').val(die_size);
    $('input[name=out_side_seam_number_out]').val(number_out);
    $('input[name=out_side_seam_die_number]').val(die_number);
    $('input[name=out_side_seam_seal_flap_size]').val(seal_flap_size);
    $('input[name=out_side_seam_sheet_size]').val(sheet_size);
    $('input[name=out_side_seam_flat_size]').val(flat_size);

});

$('input[name=web_ro_die_size]').typeahead(
    null,
    {
      name: 'webs',
      display: 'die_size',
      source: substringMatcher(webs),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });  

$('input[name=adjustable_die_size]').typeahead(
    null,
    {
      name: 'adjustables',
      display: 'die_size',
      source: substringMatcher(adjustables),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });  

 $('input[name=adjustable_die_number]').typeahead(
    null,
    {
      name: 'adjustables',
      display: 'die_number',
      source: dieNumberMatcher(adjustables),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });  



  

  $('input[name=out_diagonal_die_size]').typeahead(
    null,
    {
      name: 'diagonals',
      display: 'die_size',
      source: substringMatcher(diagonals),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });  

 $('input[name=out_diagonal_die_number]').typeahead(
    null,
    {
      name: 'diagonals',
      display: 'die_number',
      source: dieNumberMatcher(diagonals),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });  

$('input[name=out_mo_booklet_die_size]').typeahead(
    null,
    {
      name: 'booklet',
      display: 'die_size',
      source: substringMatcher(booklets),
      limit: 300,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });

 $('input[name=out_mo_booklet_die_number]').typeahead(
    null,
    {
      name: 'booklet',
      display: 'die_number',
      source: dieNumberMatcher(booklets),
      limit: 300,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
 });

$('input[name=out_mo_catalog_die_size]').typeahead(
    null,
    {
      name: 'catalog',
      display: 'die_size',
      source: substringMatcher(catalogs),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
});

$('input[name=out_mo_catalog_die_number]').typeahead(
    null,
    {
      name: 'catalog',
      display: 'die_number',
      source: dieNumberMatcher(catalogs),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
});

$('input[name=out_side_seam_die_size]').typeahead(
    null,
    {
      name: 'sideSeam',
      display: 'die_size',
      source: substringMatcher(outSideSeams),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
});

$('input[name=out_side_seam_die_number]').typeahead(
    null,
    {
      name: 'sideSeam',
      display: 'die_number',
      source: dieNumberMatcher(outSideSeams),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

          return '<tr><td>' + data.die_size + '</td><td>' + data.sheet_size + '</td><td>' + data.number_out + '</td><td>' + data.die_number + '</td><td>' + data.flat_size + '</td><td>' +  data.seal_flap_size + '</td></tr>'

        }      
      }
});

</script>

<script>

const emailPackingSlip = () => {

  const contacts = {!! $contacts !!};
  

  const contactsMatcher = function(strs) {
      
      return function findMatches(q, cb) {
          
        var matches, substringRegex;

        const customerId = $('select[name=CustomerId]').val();

        matches = [];

        substrRegex = new RegExp(q, 'i');

        $.each(strs, function(i, str) {          

          if ( ( substrRegex.test(str.name) || substrRegex.test(str.email)) && (str.customer_id === parseInt(customerId)) ) {
            matches.push(str);
          }
        
        });

        cb(matches);

      };
  };

  $('#email-packing-slip input[name=email]').typeahead(  
    {
      minLength: 0,
    },
    {
      name: 'email',
      display: 'email',
      source: contactsMatcher(contacts),
      limit: 399,
      templates: {
        empty: [
          '<div class="empty-message">',
            'No data',
          '</div>'
        ].join('\n'),
        suggestion: function (data)  {

            return `<dl><dt>${data.name}</dt><dt>${data.email}</dt></dl>`

        }      
      }    
    });    

};

$('select[name=select]').on('change', function(e) {

  const value = e.target.value;

  location.href = `/production-orders/${value}/edit`

});
    
</script>



@endsection