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
</form>