@foreach($windowSizes as $i => $s)

<tr data-index="{{ $i + 1 }}" data-id={{ $s->id }} data-text="{{ $s->PanelDie }}" data-module="WindowSize">

    <td>{{ $i  + 1}}</td>

    <td>{{ $s->PanelDie }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach