<div class="p-4">
    <div class="row">
        <div class="col">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Window Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $i => $location)

                    <tr>

                        <td>{{ $i  + 1}}</td>

                        <td>{{ $location->location }}</td>

                        <td>
                            <Button class="btn btn-primary">Edit</Button>
                            <Button class="btn btn-danger">Delete</Button>
                        </td>

                    </tr>

                    @endforeach
                </tbody>                
            </table>

            <h3>Add Window Position</h3>

            <form method="post" class="add-window-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Location:</label>
                    <input type="text" class="form-control mr-3" require name="location" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>