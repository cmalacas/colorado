<form>
<input type="hidden" name="id" value="">
@component('ui.inputs.text',
[
  'label' => 'Name',
  'placeholder' => 'Name',
  'name' => 'name',
  'value' => '',
  'class' => 'form-control'
])
@endcomponent

<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#contacts">Contacts</a>
  </li>
  <li class="nav-item" role="presentation">
  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#shipto">Ship To</a>
  </li>

</ul>

<div class="tab-content">

  <div id="contacts" role="tabpanel" class="mt-4 ml-2 mr-2">

    <h3>Contacts</h3>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <td>Name</t>
              <td>Email</td>
              <td>Phone / Ext</td>
              <td>Mobile</td>
              <td>Fax</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5">
                &nbsp;
              </td>
              <td><a href="#" class="btn btn-danger"><i class="fa fa-plus"></i></a></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>

  <div id="shipto" role="tabpanel" class="mt-4 ml-2 mr-2">
    <h3>Ship To</h3>
  </div>

</div>

</form>