<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Stand Number</th>
					<th>Name</th>
					<th>Country</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $exhibitors as $exhibitor )
				<tr>
					<td>{{ $exhibitor->standNumber }}</td>
					<td>
						<a href="{{ route('dashboard.exhibitors.show', $exhibitor->id) }}">
							{{ $exhibitor->name }}
						</a>
					</td>
					<td>{{ $exhibitor->country }}</td>
					<td class="right" width="100">
						<form method="POST" action="{{ route('dashboard.exhibitors.destroy', $exhibitor->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('dashboard.exhibitors.edit', $exhibitor->id) }}" class="btn btn-primary">
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