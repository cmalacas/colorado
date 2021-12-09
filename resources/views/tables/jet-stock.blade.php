<div class="p-4">
    <div class="row">
        <div class="col table-wrapper">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th style="width:30px">ID</th>
                        <th style="width:300px">Jet Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('tables.jet-stock-data')
                </tbody>                
            </table>

            <h3>Add Jet Stock</h3>

            <form method="post" class="add-jet-stock-form">
                <div class="form-group form-inline">
                    <label class="mr-3">Jet Stock:</label>
                    <input type="text" class="form-control mr-3" require name="stock" />
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>