<div class="p-4">
    <div class="row">
        <div class="col">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.description-data')
                </tbody>                
            </table>

            <h3>Add Description</h3>

            <form method="post" class="add-description-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Description:</label>
                    <input type="text" class="form-control mr-3" require name="description" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>