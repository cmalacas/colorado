<table class="table {{ $class }}">
	<thead>
		<tr>
            @foreach($theads as $thead)
                <th>{{ $thead }}</th>
            @endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($tbody as $row)
			<tr>
				@foreach($row as $val)
					<td>{!! $val !!}</td>
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>