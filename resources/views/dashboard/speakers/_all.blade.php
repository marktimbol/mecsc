<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Designation</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $speakers as $speaker )
				<tr>
					<td width="200">
						<a href="{{ route('dashboard.speakers.show', $speaker->id) }}">{{ $speaker->name }}</a>
					</td>
					<td>{{ sprintf('%s at %s', $speaker->designation, $speaker->company) }}</td>
					<td class="right" width="100">
						<form method="POST" action="{{ route('dashboard.speakers.destroy', $speaker->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('dashboard.speakers.edit', $speaker->id) }}" class="btn btn-primary">
								<i class="fa fa-pencil"></i>
							</a>
							<button type="submit" class="btn btn-danger">&times;</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
	</div>
</div>