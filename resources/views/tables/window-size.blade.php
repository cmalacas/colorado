<div class="p-4">
    <div class="row">
        <div class="col">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Window Size</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.window-size-data')
                </tbody>                
            </table>

            <h3>Add Window Size</h3>

            <form method="post" class="add-window-size-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Size:</label>
                    <input type="text" class="form-control mr-3" require name="size" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>