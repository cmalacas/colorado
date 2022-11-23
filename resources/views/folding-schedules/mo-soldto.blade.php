<div class="form-group">
    <select name="order[{{ $r->id }}][CustomerId]" class="form-control">
        <option value="0">--- select customer ---</option>
        @foreach($customers as $c)
            @if ($r->CustomerId == $c->id)
                <option selected="selected" value="{{ $c->id }}">{{ $c->name }}</option>
            @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endif
        @endforeach
    </select>
</div>