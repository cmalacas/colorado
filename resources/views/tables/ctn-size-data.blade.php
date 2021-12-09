@foreach($cartoons as $i => $c)

<tr data-index="{{ $i + 1 }}" data-id={{ $c->id }} data-text="{{ $c->size }}" data-module="Cartoon Size">

    <td>{{ $i  + 1}}</td>

    <td>{{ $c->size }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach