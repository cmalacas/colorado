@foreach($gums as $i => $g)

<tr data-index="{{ $i + 1 }}" data-id={{ $g->id }} data-text="{{ $g->gum }}" data-module="Gum">

    <td>{{ $i  + 1}}</td>

    <td>{{ $g->gum }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach