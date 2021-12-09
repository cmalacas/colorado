@foreach($jets as $i => $g)

<tr data-index="{{ $i + 1 }}" data-id={{ $g->id }} data-text="{{ $g->status }}" data-module="Jet-Status"">

    <td>{{ $i  + 1}}</td>

    <td>{{ $g->status }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach