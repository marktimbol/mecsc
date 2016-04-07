<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Date</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $schedules as $schedule )
				<tr>
					<td>{{ $schedule->eventDate }}</td>
					<td class="right" width="80">
						<form method="POST" action="{{ route('dashboard.schedules.destroy', $schedule->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<button type="submit" class="btn btn-danger">&times;</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>		
	</div>
</div>