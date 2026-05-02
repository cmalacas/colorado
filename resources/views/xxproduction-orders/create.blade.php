@extends('layouts.plane')

@section('title', 'Production Orders')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Production Orders - Create</h4>
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

    <form method="POST" autocomplete="off" action="/production-orders" id="productOrderForm">

        @csrf

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">



                    <div class="text-right p-2">
                        <button onClick="return javascript:productOrderForm.submit();"  class="btn btn-primary">Save</button>
                    </div>

                    <ul class="nav nav-tabs" role="tablist"> 
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        </li>                      
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                           
                            @include('production-orders.edit-general')
                        </div>                     
                    </div>

                    <div class="text-right p-2">
                        <button  onClick="return javascript:productOrderForm.submit();" href="/"  class="btn btn-primary">Save</button>
                    </div>
                    
                </div>
            
            </div>

        </div>

    </div>

    </form>

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
    'button' => 'Save'
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


@endsection

@section('script')

<script src="{}"></script>

<script>

function phone_formatting(ele,restore) {
  var new_number,
      selection_start = ele.selectionStart,
      selection_end = ele.selectionEnd,
      number = ele.value.replace(/\D/g,'');
  
  // automatically add dashes
  if (number.length > 2) {
    // matches: 123 || 123-4 || 123-45
    new_number = number.substring(0,3) + '-';
    if (number.length === 4 || number.length === 5) {
      // matches: 123-4 || 123-45
      new_number += number.substr(3);
    }
    else if (number.length > 5) {
      // matches: 123-456 || 123-456-7 || 123-456-789
      new_number += number.substring(3,6) + '-';
    }
    if (number.length > 6) {
      // matches: 123-456-7 || 123-456-789 || 123-456-7890
      new_number += number.substring(6);
    }
  }
  else {
    new_number = number;
  }
  
  // if value is heigher than 12, last number is dropped
  // if inserting a number before the last character, numbers
  // are shifted right, only 12 characters will show
  ele.value =  (new_number.length > 12) ? new_number.substring(0,12) : new_number;
  
  // restore cursor selection,
  // prevent it from going to the end
  // UNLESS
  // cursor was at the end AND a dash was added
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

    $('select[name=CustomerId]').select2();

    $('.date').datepicker({dateFormat: "mm-dd-yy"});

    $('input[name=Phone], input[name=Mobile], input[name=Fax]').on('keyup', function(e) {
        phone_number_check(this, e);
    });   
})

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

        $size = ui.item.EnvelopeSize.split(" x ");

        console.log('size', $size, ui.item);

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

<<script>
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
 
    $( "input[name=Description]" ).autocomplete({
      minLength: 0,
      source: descriptions,
      focus: function( event, ui ) {
        $( "input[name=Description]" ).val( ui.item.label );
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
  } );
  </script>


<script>
  $( function() {
    var seals = {!! $seals !!};
 
    $( "input[name=SealFlap]" ).autocomplete({
      minLength: 0,
      source: seals,
      focus: function( event, ui ) {
        $( "input[name=SealFlap]" ).val( ui.item.label );
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
  } );
  </script>

@endsection