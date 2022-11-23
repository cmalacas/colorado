var contactCounter = 0;
const customers = {
  init() {
    $(document).on('click', '.btn-customer', customers.show);
    $(document).on('click', '#customer-table-modal .modal-body .btn-primary', customers.edit);
    $(document).on('click', '#customer-table-modal .modal-body .btn-success', customers.select);
    $(document).on('click', '#customer-table-modal .btn-primary', customers.add);
    $(document).on('click', '#customer-table-modal .modal-footer .btn-secondary', customers.close);
    
    $(document).on('click', '#edit-customer-modal .modal-footer .btn-primary', customers.update);
    $(document).on('click', '#edit-customer-modal .modal-footer .btn-danger', customers.delete);
    $(document).on('click', '#edit-customer-modal tfoot .btn-danger', customers.addContact);
    $(document).on('click', '#edit-customer-modal tbody .btn-danger', customers.deleteContact);
    $(document).on('click', '#edit-customer-modal .modal-footer .btn-success', customers.hideContact);
    
    $(document).on('click', '#add-customer-modal tbody .btn-danger', customers.deleteContact)
    $(document).on('click', '#add-customer-modal tfoot .btn-danger', customers.addContact);    
    $(document).on('click', '#add-customer-modal .modal-footer .btn-primary', customers.save);

    $(document).on('keyup', '#edit-customer-modal .contact-phone', function(e) { customers.contact_phone_number_check(this, e) });
    $(document).on('keyup', '#add-customer-modal .contact-phone', function(e) { customers.contact_phone_number_check(this, e) });
  },

  contact_phone_formatting(ele,restore) {
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
    
    //document.getElementById('msg').innerHTML='<p>Selection is: ' + selection_end + ' and length is: ' + new_number.length + '</p>';
    
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

  contact_phone_number_check(field, e) {    

    console.log('code', Number(e.key));

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

    console.log('key string', key_string);
    
    // only force formatting is a number or delete key was pressed
    if ((key_code >= 96 && key_code <= 105) || key_string.match(/^\d+$/) || press_delete) {
      console.log('here 1')
      customers.contact_phone_formatting(field,press_delete);
    }
    // do nothing for direction keys, keep their default actions
    else if(direction_key.indexOf(key_code) > -1) {
      // do nothing
      console.log('here 2');
    }
    else if(dash_key === key_code) {
      if (selection_end === field.value.length) {
        field.value = field.value.slice(0,-1)
        console.log('here 3')
      }
      else {
        field.value = field.value.substring(0,(selection_end - 1)) + field.value.substr(selection_end)
        field.selectionEnd = selection_end - 1;
        console.log('here 4')
      }
    }
    // all other non numerical key presses, remove their value
    else {
      e.preventDefault();
      console.log('here 5')
  //    field.value = field.value.replace(/[^0-9\-]/g,'')
      customers.contact_phoyoune_formatting(field,'revert');
    }
  
  },



  select() {

    const id = $(this).data('id');

    $.ajax( {

      url: '/customers/gets',
      method: 'get',
      dataType: 'json',
      success: (data) => {

        const selects = data.customers.map(c => {

            let selected = c.id == id;

            if (selected)

              return `<option selected  value="${c.id}">${c.name}</option>`

            else

              return  `<option  value="${c.id}">${c.name}</option>`

        });

        $('#customer-table-modal').hide();

        $('select[name=CustomerId]').html(selects.join(''));

      }

    })

  },

  close() {
    $('#customer-table-modal').hide();
  },

  save() {
    const data = $('#add-customer-modal form').serialize();

    $.ajax({
      url: `/customers`,
      method: 'post',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: data,
      dataType: 'json',
      success: function(response)
      {
        const customers = response.customers;
        const customerID = response.customer_id;
        var html = ''

        if ($('select[name=CustomerId]').length > 0) {
          for(var i=0; i < customers.length; i++) {
            if (customers[i].id === customerID) {
              html += `<option value="${customers[i].id}" selected="selected">${customers[i].name}</option>`;
            } else {
              html += `<option value="${customers[i].id}">${customers[i].name}</option>`;
            }            
          }

          $('select[name=CustomerId]').html(html);

          $('select[name=CustomerId]').select2();
        }

        $('#customer-table-modal .modal-body').html(response.table);

        $('#customer-table-modal .table').DataTable( {
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }]
          }
        );

        $('#add-customer-modal').modal('hide');
        $('#customer-table-modal').hide();

      }
    })

    return false;
  },

  hideContact() {
    const id = $('#edit-customer-modal input[name=id]').val();

    $.ajax(
      {
        url: `/customers/${id}/hide`,
        method: 'get',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {

          $(`#customer-table-modal #row${id}`).remove();

          $('#edit-customer-modal').modal('hide');
          
        }
      } 
    )
  },

  deleteContact() {
    const id = $(this).data('id');
    $(`#contact-row${id}`).remove();
  },

  delete() {
    const id = $('#edit-customer-modal input[name=id]').val();

    if (confirm('This will delete the customer info and contact lists. This cannot be undone. Are you sure you want to delete this?'))
    {
      $.ajax(
        {
          url: `/customers/${id}`,
          method: 'delete',
          dataType: 'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(response) {

            $('#customer-table-modal .modal-body').html(response.table);

            $('#customer-table-modal .table').DataTable( {
                columnDefs: [ {
                    targets: [ 0 ],
                    orderData: [ 0, 1 ]
                }]
              }
            );

            $('#edit-customer-modal').modal('hide');
          }
        } 
      )  
    }
  },

  addContact() {

    const table = $(this).closest('.modal');

    const html = `
      <tr id="row${contactCounter}">
        <td>
          <input type="hidden" name="contact[${contactCounter}][id]" value="0">
          <input class="form-control" type="text" name="contact[${contactCounter}][name]" placeholder="Name">
        </td>
        <td>
          <input class="form-control" type="text" name="contact[${contactCounter}][email]" placeholder="Email">
        </td>
        <td>
          <input class="form-control contact-phone" type="text" name="contact[${contactCounter}][phone]" placeholder="Phone">
          <input class="form-control contact-phone-ext" type="text" name="contact[${contactCounter}][ext]" placeholder="Ext">
        </td>
        <td>
          <input class="contact-phone mobile form-control" type="text" name="contact[${contactCounter}][mobile]" placeholder="Mobile">
        </td>
        <td>
          <input class="contact-phone fax form-control" type="text" name="contact[${contactCounter}][fax]" placeholder="Fax">
        </td>
        <td>
          <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        </td>
      </tr>`;

    $('tbody', table).append(html);

    contactCounter++;

    return false;

  },

  update() {

    const data = $('#edit-customer-modal form').serialize();

    const id = $('#edit-customer-modal input[name=id]').val();

    $.ajax({
      url: `/customers/${id}`,
      method: 'patch',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: data,
      dataType: 'json',
      success: function(response)
      {
        $('#edit-customer-modal').modal('hide');
      }
    })

    return false;
  },

  edit() {
    const id = $(this).data('id');
    $.ajax(
      {
        url: `/customers/${id}/edit`,
        dataType: 'json',
        success: function(response) {
          const customer = response.customer;
          const contacts = response.contacts;
          $('#edit-customer-modal input[name=id]').val(customer.id);
          $('#edit-customer-modal input[name=name]').val(customer.name);

          $('#edit-customer-modal .modal-body tbody').html(response.table);

          if (contacts.length > 0) {
            contactCounter = contacts.length;
          }

          

          $('#edit-customer-modal .phone').trigger('keyup');
          $('#edit-customer-modal').modal('show');
        }
      }
    );
    return false;
  },

  show() {
    $.ajax(
      {
        url: '/customers',
        dataType: 'json',
        success: function(response)
        {
          $('#customer-table-modal .modal-body').html(response.table);

          $('#customer-table-modal .table').DataTable( {
            lengthChange: false,
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }]
          });

          $('#customer-table-modal').show('show');
        }
      });

    
    return false;
  },

  add() {
    contactCounter = 0;
    $('#add-customer-modal').modal('show');
  }


}

$(document).ready(function() {
  customers.init();
});