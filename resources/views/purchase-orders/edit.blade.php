@extends('layouts.plane')

@section('title', 'Purchase Orders')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Purchase Order - Edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="/purchase-orders">Purchase Orders</a></li>
                    <li class="breadcrumb-item active">{{ $val->id }}</li>
                </ol>
            
            </div>
        </div>
    </div>

    @if(session('message'))
        <div class="row">
            <div class="col-md-10 offset-1 bg-success text-light pt-2 pb-2">
                {{session('message')}}
            </div>
        </div>
    @endif

    <form class="purchase-orders" method="post" action="/purchase-orders/{{ $val->id }}">

        @csrf
        @method('PUT')

    <div class="row form">

        

        <div class="col-md-10 offset-1">

            <div class="row buttons">

                <div class="col-md-2 text-right float-right">

                    <a class="btn btn-primary" data-toggle="tooltip" title="Save" data-action="save"><i class="fa fa-save"></i></a>
                    <a class="btn btn-info" data-toggle="tooltip" title="Print" data-action="print" href="/purchase-orders/{{ $val->id }}/print" target="_blank"><i class="fa fa-print"></i></a>
                    <a class="btn btn-success" data-toggle="tooltip" title="Copy" data-action="copy" href="/purchase-orders/{{ $val->id }}/copy"]"><i class="fa fa-copy"></i></a>
                    <a class="btn btn-secondary" data-toggle="tooltip" title="Cancel" data-action="cancel" href="/purchase-orders"><i class="fa fa-reply"></i></a>

                </div>

            </div>

            <ul class="nav nav-tabs" role="tablist"> 
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="converting-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="converting" aria-selected="false">Documents</a>
                </li>
            </ul>

            <div class="row">

                <div class="col-md-6">

                    @component('ui.inputs.text', [
                        'name' => 'id',
                        'value' => $val->id,
                        'placeholder' => 'Purchase Order #',
                        'readonly' => true,
                        'class' => 'form-control'
                    ])
                    @endcomponent

                    @component('ui.inputs.select', [
                        'name' => 'to',
                        'value' => $val->to,
                        'options' => $vendors,
                        'placeholder' => 'To',
                        'class' => 'form-control'
                    ])
                    @endcomponent

                   

                    @component('ui.inputs.text', [
                        'name' => 'phone',
                        'value' => $val->phone,
                        'placeholder' => 'Phone',
                        'class' => 'form-control phone'
                    ])
                    @endcomponent

                    @component('ui.inputs.text', [
                        'name' => 'cellphone',
                        'value' => $val->cellphone,
                        'placeholder' => 'Cellphone',
                        'class' => 'form-control phone'
                    ])
                    @endcomponent

                    @component('ui.inputs.text', [
                        'name' => 'email',
                        'value' => $val->email,
                        'placeholder' => 'Email',
                        'class' => 'form-control'
                    ])
                    @endcomponent


                    @component('ui.inputs.select', [
                        'name' => 'ship',
                        'value' => $val->ship,
                        'placeholder' => 'Ship',
                        'options' => ['Pickup', 'Ship Via'],
                        'class' => 'form-control'
                    ])
                    @endcomponent

                    

                </div>

                <div class="col-md-6">

                    @component('ui.inputs.text', [
                        'name' => 'todaysdate',
                        'value' => $val->todaysdate,
                        'placeholder' => 'Todays Date',
                        'class' => 'form-control date'
                    ])
                    @endcomponent

                    @component('ui.inputs.text', [
                        'name' => 'datereqd',
                        'value' => $val->datereqd,
                        'placeholder' => 'Date Required',
                        'class' => 'form-control date'
                    ])
                    @endcomponent

                    @component('ui.inputs.text', [
                        'name' => 'fax',
                        'value' => $val->fax,
                        'placeholder' => 'Fax',
                        'class' => 'form-control phone'
                    ])
                    @endcomponent

                    
                    @component('ui.inputs.text', [
                        'name' => 'for',
                        'value' => $val->for,
                        'placeholder' => 'For',
                        'class' => 'form-control'
                    ])
                    @endcomponent

                    
                    @component('ui.inputs.text', [
                        'name' => 'shippingco',
                        'value' => $val->shippingco,
                        'placeholder' => 'Shipping Company',
                        'class' => 'form-control'
                    ])
                    @endcomponent
        
                    

                </div>

            </div>

            <div class="row">

                    <div class="col-md-12">

                        <table id="purchase-order-form" class="table table-bordered table-hover">

                            <thead>

                                <tr>
                                    <th>Production Order #</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Received</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>                              

                                @php $itemCounter = 0; @endphp

                                @foreach($items as $item)

                                <tbody id="item{{ $itemCounter }}">

                                @component('purchase-orders.form',
                                    [
                                        'ColoEnvPO' => $ColoEnvPO,
                                        'val' => $item,
                                        'item' => $itemCounter
                                    ])
                                @endcomponent

                                @php $itemCounter++; @endphp

                                </tbody>

                                @endforeach

                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td class="text-center">
                                  
                                        <button class="btn-add btn btn-success"><i class="fa fa-plus"></i> Add Item</button>
    
                                    </td>
                                </tr>
                            </tfoot>


                        </table>

                    </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    @component('ui.inputs.textarea', [
                        'name' => 'comments',
                        'value' => $val['comments'],
                        'placeholder' => 'Comments',
                        'class' => 'form-control'

                    ])
                    @endcomponent


                </div>

            </div>

            <div class="row buttons">

                 <div class="col-md-1">       

                        <a data-action="save" class="btn btn-primary">Save</a>

                 </div>

            </dvi>

        </div>

    </div>

    </form>
    <style>    
.form table td .form-group {
    margin-bottom: 0;
}

.form table td {
    padding-left:0;
    padding-right:0;
    padding-bottom:1px;
    padding-top:1px;
}

.form table td .row {
    margin-left: 0;
    margin-right: 0;
}

.form table td .col-md-12 {
    padding-left:0;
    padding-right:0;
}

.row.buttons {
    padding: 20px 0;
    justify-content: flex-end;
}

.btn.btn-primary {
    color: #fff !important;
}

.form-control[readonly] {
    opacity: 0.7;
    border-color: #666;
}
</style>

@endsection

@section('script')

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

</script>

<script>

let item = @php echo $itemCounter; @endphp;

const pos = {!! $productionOrders !!}

$(document).ready(function() {

    $('.date').datepicker({dateFormat: "yy-mm-dd"});

    $('select.po').select2();

    $('.row.buttons a').on('click', function() {

        const action = $(this).data('action');

        if (action === 'save') {
            $('form.purchase-orders').submit();
            return false;
        } else {
            return true;
        }
    });

    $('input.phone').on('keyup', function(e) {
        phone_number_check(this, e);
    });

    $(document).on('click', '#purchase-order-form .btn-delete', function() {
        
        const item = $(this).data('value');

        $(`#item${item}`).remove();

        return false;
    
    });

    $(document).on('change', 'select.po', function() {
    
        const value = $(this).val();

        const row = $(this).closest('tr');

        const po = pos.filter( p => p.id === parseInt(value));

        if (po.length > 0) {

            const description = po[0].Desc;
            const price = po[0].QuotedPrice;
            const qty = po[0].QtyNeeded;
            const allow = po[0].OversAllow;

            const totalQty = qty + (qty * allow / 100);

            //$('.desc', row).val(description);
            //$('.qty', row).val(totalQty);
            //$('.price', row).val(price);

        }

    });


    $(document).on('click', '#purchase-order-form .btn-add', function() {
        
        const form = $(this).closest('tr');

        const po = $('select.po', form).val();

        let html = `<tbody id="item${item}"><tr>`;
            html += '<td>'

            html += `<select name="items[${item}][po]" class="form-control po">`

            html += '<option value="0"></option>'

            @foreach($ColoEnvPO as $po)

                html += '<option value="{{ $po }}">{{ $po }}</option>'

            @endforeach

            html += '</select>';

            html += '</td><td>'

            html += `<input class="form-control qty" type="text" name="items[${item}][qty]" value="" />`;

            
            html += '</td><td>'

            html += `<input class="form-control price" type="text" name="items[${item}][price]" value="" />`;

            html += '</td><td>'

            html += `<select class="form-control recvd" type="text" name="items[${item}][recvd]">`;

            html += '<option value=""></option>'
            html += '<option value="Partial">Partial</option>'
            html += '<option value="Complete">Complete</option>'

            html += '</select>'

            html += '</td><td >'

            html += `<input class="form-control date" type="text" name="items[${item}][date]" value="" />`;

            html += '</td><td rowspan="2" class="align-middle text-center alig-middle">'

            html += `<button data-toggle="tooltip" title="Remove" data-value="${item}" class="btn btn-delete btn-danger"><i class="fa fa-times"></i></button>`;

            html += '</td>'      
            
            html += '</tr><tr>'

            html += '<td class="form-group" colspan="5">'

            html += `<textarea style="height: 100px;" name="items[${item}][desc]" class="form-control"></textarea>`

            html += '</td>'

            html += '</tr></tbody>'

       

        $('#purchase-order-form tfoot').before(html);

        $('.date').datepicker({dateFormat: "yy-mm-dd"});

        $('select.po').select2();

        $('[data-toggle="tooltip"]').tooltip()

        item++;

        return false;
    });
})

</script>

@endsection