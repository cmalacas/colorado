const productionOrders = {
  init() {
    $(document).on('click', '.po-search-button', productionOrders.openSearch);
    $(document).on('click', '#production-orders-search-modal .btn-primary', productionOrders.submitSearch);
    $(document).on('click', '.add-out-diagonal', productionOrders.addOutDiagonal);
    $(document).on('click', '.add-mo-booklet', productionOrders.addMoBooklet);
    $(document).on('click', '.add-mo-catalog', productionOrders.addMoCatalog);
    $(document).on('click', '.add-side-seam', productionOrders.addSideSeam);
    $(document).on('click', '#email-packing-slip .modal-footer .btn-primary', productionOrders.sendPackingSlip)    
  },

  phone_formatting(ele,restore) {
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
  
  },


  phone_number_check(field,e) {
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
      this.phone_formatting(field,press_delete);
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
      this.phone_formatting(field,'revert');
    }
  
  },
  


  sendPackingSlip() {

    const data = $('#email-packing-slip form').serialize();

    const form = $('#email-packing-slip form');

    const email = $('input[name=email]', form).val();

    if (email === '') {

      alert('email is required');

    } else {

      $('#email-packing-slip .modal-footer .btn-primary').html('Sending, please wait...')

      $.ajax( {

        url: '/packing/sent',
        data: data,
        type: 'post',
        dataType: 'json',
        success: (response) => {
          if (response.success === 1) {
            $('#email-packing-slip .modal-footer .btn-primary').html('Send');
            $('#email-packing-slip').modal('hide');
          }
        }

      })

    }

  },

  addMoBooklet() {

    const die_size = $('input[name=out_mo_booklet_die_size]').val();
    const sheet_size = $('input[name=out_mo_booklet_sheet_size]').val();
    const number_out = $('input[name=out_mo_booklet_number_out]').val();
    const die_number = $('input[name=out_mo_booklet_die_number]').val();
    const flat_size = $('input[name=out_mo_booklet_flat_size]').val();
    const seal_flap_size = $('input[name=out_mo_booklet_seal_flap_size]').val();

    $('.add-mo-booklet').html('Saving...');

    $.ajax({
      url: '/production-orders/addmobooklet',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {die_size, sheet_size, number_out, die_number, seal_flap_size, flat_size},
      dataType: 'json',
      success: function(data) {
        if (data.success === 1) {
            $('.add-mo-booklet').html('<i class="fa fa-plus"></i> Add');
        }
      }
    })
      

  },

  addMoCatalog() {

    const die_size = $('input[name=out_mo_catalog_die_size]').val();
    const sheet_size = $('input[name=out_mo_catalog_sheet_size]').val();
    const number_out = $('input[name=out_mo_caalog_number_out]').val();
    const die_number = $('input[name=out_mo_catalog_die_number]').val();
    const flat_size = $('input[name=out_mo_catalog_flat_size]').val();
    const seal_flap_size = $('input[name=out_mo_catalog_seal_flap_size]').val();

    $('.add-mo-catalog').html('Saving...');

    $.ajax({
      url: '/production-orders/addmocatalog',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {die_size, sheet_size, number_out, die_number, seal_flap_size, flat_size},
      dataType: 'json',
      success: function(data) {
          if (data.success === 1) {
            $('.add-mo-catalog').html('<i class="fa fa-plus"></i> Add');
          }
      }
    })

  },

  addSideSeam() {

    const die_size = $('input[name=out_side_seam_die_size]').val();
    const sheet_size = $('input[name=out_side_seam_sheet_size]').val();
    const number_out = $('input[name=out_side_seam_number_out]').val();
    const die_number = $('input[name=out_side_seam_die_number]').val();
    const flat_size = $('input[name=out_mo_booklet_flat_size]').val();
    const seal_flap_size = $('input[name=out_side_seam_seal_flap_size]').val();
    
    $('.add-side-seam').html('Saving...');

    $.ajax({
      url: '/production-orders/addsideseam',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {die_size, sheet_size, number_out, die_number, seal_flap_size, flat_size},
      dataType: 'json',
      success: function(data) {
        if (data.success === 1) {
            $('.add-side-seam').html('<i class="fa fa-plus"></i> Add');
        }
      }
    })

  },

  addOutDiagonal() {

    const die_size = $('input[name=out_diagonal_die_size]').val();
    const sheet_size = $('input[name=out_diagonal_sheet_size]').val();
    const number_out = $('input[name=out_diagonal_number_out]').val();
    const die_number = $('input[name=out_diagonal_die_number]').val();
    const seal_flap_size = $('input[name=out_diagonal_seal_flap_size]').val();

    $('.add-out-diagonal').html('Saving...');

    $.ajax({
      url: '/production-orders/adddiagonal',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {die_size, sheet_size, number_out, die_number, seal_flap_size},
      dataType: 'json',
      success: function(data) {
        if (data.success === 1) {
            $('.add-out-diagonal').html('<i class="fa fa-plus"></i> Add');
        }
      }
    })

  },

  submitSearch() {

    $.ajax({
      url: '/production-orders-search',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: $('#production-orders-search-modal form').serialize(),
      dataType: 'json',
      success: () => {
        $('#production-orders-search-modal').modal('hide');
        window.location = '/production-orders'
      }
    })

    
  },

  openSearch() {
    $('#production-orders-search-modal').modal('show');
    return false;
  },

  getContacts() {   

    $.ajax({
      url: '/production-orders/getcontacts',
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: data,
      success: function(response) {

      }
    })
  }
}

$(document).ready(function() {  
  
  productionOrders.init();

  $( "input[name=ContactName]" ).autocomplete({
    source: function( request, response ) {

      const SoldTo = $('select[name=CustomerId]').val();
      const data = {SoldTo};
      
      $.ajax({
        url: '/production-orders/getcontacts',
        method: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        dataType: 'json',
        success: function(data) {
          response(data)
        }
      })
    },
    minLength: 0,
    select: function( event, ui ) {
      $('input[name=Email]').val(ui.item.email);
      $('input[name=Phone]').val(ui.item.phone).trigger('change');
      $('input[name=PhoneExt]').val(ui.item.ext);
      $('input[name=Mobile]').val(ui.item.mobile);
      $('input[name=Fax]').val(ui.item.fax);
    }
  } ).bind('focus', function(){ $(this).autocomplete("search"); } );

  $( "input[name=ShipTo]" ).autocomplete({
    source: function( request, response ) {

      const SoldTo = $('select[name=CustomerId]').val();
      const data = {SoldTo};
      
      $.ajax({
        url: '/production-orders/getshipto',
        method: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        dataType: 'json',
        success: function(data) {
          response(data)
        }
      })
    },
    minLength: 0,
    select: function( event, ui ) {
      $('input[name=Address1]').val(ui.item.address1);
      $('input[name=Address2]').val(ui.item.address2);
      $('input[name=City]').val(ui.item.city);
      $('input[name=ST]').val(ui.item.state);
      $('input[name=Zip]').val(ui.item.zip);
      $('input[name=ShipAttn]').val(ui.item.attn);
      $('input[name=ShipContactPhone]').val(ui.item.phone);
    }
  } ).bind('focus', function(){ $(this).autocomplete("search"); } );
});

