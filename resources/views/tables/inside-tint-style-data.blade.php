@foreach($tints as $i => $t)

<tr data-index="{{ $i + 1 }}" data-id={{ $t->id }} data-text="{{ $t->style }}" data-module="Tint">

    <td>{{ $i  + 1}}</td>

    <td>{{ $t->style }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach