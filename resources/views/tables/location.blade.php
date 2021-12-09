<div class="p-4">
    <div class="row">
        <div class="col table-wrapper">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.location-data')
                </tbody>                
            </table>

            <h3>Add Location</h3>

            <form method="post" class="add-location-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Location:</label>
                    <input type="text" class="form-control mr-3" require name="location" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>