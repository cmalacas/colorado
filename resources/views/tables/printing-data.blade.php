@foreach($prints as $i => $p)

<tr data-index="{{ $i + 1 }}" data-id={{ $p->id }} data-text="{{ $p->print }}" data-module="Printing">

    <td>{{ $i  + 1}}</td>

    <td>{{ $p->print }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach