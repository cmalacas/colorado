<form>
    <div class="form-group">

        <label>Find What:</label>

        <input type="text" name="search" class="form-control">

    </div>

    <div class="form-group">

        <label>Look In:</label>

        <select name="lookin" class="form-control">

            @foreach($fields as $key => $field) 

            <option value={{ $key }}>{{ $field }}</option>

            @endforeach

        </select>

    </div>

    <div class="form-group">

        <label>Match:</label>

        <select name="match" class="form-control">

            <option value="any">Any Part of Field</option>
            <option value="whole">Whole Field</option>
            
            <option value="start">Start of Field</option>

        </select>

    </div>
</form>

