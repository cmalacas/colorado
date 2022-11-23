<div class="p-4">
    <div class="row">
        <div class="col">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Window Film</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.window-film-data')
                </tbody>                
            </table>

            <h3>Add Window Film</h3>

            <form method="post" class="add-window-film-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Window Film:</label>
                    <input type="text" class="form-control mr-3" require name="window_film" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>