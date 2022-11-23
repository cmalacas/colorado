@foreach($boxes as $i => $b)

<tr data-index="{{ $i + 1 }}" data-id={{ $b->id }} data-text="{{ $b->size }}" data-module="Box Size">

    <td>{{ $i  + 1}}</td>

    <td>{{ $b->size }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach