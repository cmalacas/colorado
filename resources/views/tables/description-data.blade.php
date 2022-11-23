@foreach($descriptions as $i => $d)

<tr data-index="{{ $i + 1 }}" data-id={{ $d->id }} data-text="{{ $d->description }}" data-module="Description">

    <td>{{ $i  + 1}}</td>

    <td>{{ $d->description }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach