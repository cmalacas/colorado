@foreach($locations as $i => $location)

<tr data-index="{{ $i + 1 }}" data-id={{ $location->id }} data-text="{{ $location->location }}" data-module="Location">

    <td>{{ $i  + 1}}</td>

    <td>{{ $location->location }}</td>

    <td>
        <Button class="btn btn-edit btn-primary">Edit</Button>
        <Button class="btn btn-delete btn-danger">Delete</Button>
    </td>

</tr>

@endforeach