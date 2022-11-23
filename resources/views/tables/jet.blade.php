<div class="p-4">
    <div class="row">
        <div class="col table-wrapper">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.jet-data')
                </tbody>                
            </table>

            <h3>Add Jet Status</h3>

            <form method="post" class="add-jet-status-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Jet Status:</label>
                    <input type="text" class="form-control mr-3" require name="status" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>