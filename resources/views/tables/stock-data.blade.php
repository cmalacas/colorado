@foreach($stocks as $i => $s)

<tr data-index="{{ $i + 1 }}" data-id={{ $s->id }} data-text="{{ $s->size }}" data-module="Stock">

    <td>{{ $i  + 1}}</td>

    <td>{{ $s->size }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach