@foreach($schedules as $i => $s)

<tr data-index="{{ $i + 1 }}" data-id={{ $s->id }} data-text="{{ $s->status }}" data-module="Schedule Status">

    <td>{{ $i  + 1}}</td>

    <td>{{ $s->status }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach