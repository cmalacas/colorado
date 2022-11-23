<table class="table table-stripped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Die Size</th>
            <th>Sheet / Roll Size</th>
            <th>Number Out</th>
            <th>Die Number</th>
            <th>Flat Size</th>
            <th>Seal Flap Size</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php

            $counter = 0;

        @endphp
        @foreach($lists as $val)
        <tr id="row{{ $val->id }}" >
            <td>{{ ++$counter }}</td>
            <td>{{ $val->die_size }}</td>
            <td>{{ $val->sheet_size }}</td>
            <td>{{ $val->number_out }}</td>
            <td>{{ $val->die_number}}</td>
            <td>{{ $val->flat_size}}</td>
            <td>{{ $val->seal_flap_size}}</td>
            <td>
                <button data-id="{{ $val->id }}" data-action="edit" class="btn btn-primary">Edit</button>
                <button data-id="{{ $val->id }}" data-action="delete" class="btn btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>