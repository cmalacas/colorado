<table class="table">
  <thead>
    <tr>
      <th>Company Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($customers as $customer)
    <tr id="row{{ $customer->id }}">
      <td>{{ $customer->name }}</td>
      <td class="text-right">
        
        <a href="#" data-id="{{ $customer->id }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 

        <a href="#" data-id="{{ $customer->id }}" data-action="select" class="btn btn-success"><i class="fa fa-check"></i></a> 
        
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
  </tfoot>
</table>