@php $counter = 1; @endphp
@foreach($results as $row)

    <tr>

        <td>{{ $row->ColoEnvPO }} - {{ $counter }}</td>
        <td>{{ date("m-d-Y", strtotime($row->DateShip)) }}</td>
        <td>{{ $row->TotalShip }}</td>
        <td>{!! html_entity_decode($row->Details) !!}</td>
        <td>{{ $row->OrderStatus }}</td>
        <td>
            <a href="#" data-toggle="tooltip" title="Edit Packing Slip" data-action="edit" data-id="{{ $row->id }}" class="btn btn-success"><i class="fa fa-edit"></i></a> 
            <a href="#" data-toggle="tooltip" title="Delete Packing Slip" data-action="delete" data-id="{{ $row->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            <a href="#" data-toggle="tooltip" title="Email Packing Slip" data-action="email" data-id="{{ $row->id }}" class="btn btn-info"><i class="fa fa-envelope"></i></a>
            <a href="#" data-toggle="tooltip" title="Print Packing Slip" data-action="print" data-id="{{ $row->id }}" class="btn btn-success"><i class="fa fa-print"></i></a>
        </td>

    </tr>

    @php $counter++; @endphp

@endforeach