@foreach($machines as $i => $m)

<tr data-index="{{ $i + 1 }}" data-id={{ $m->id }} data-text="{{ $m->machine }}" data-module="Machine">

    <td>{{ $i  + 1}}</td>

    <td>{{ $m->machine }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach