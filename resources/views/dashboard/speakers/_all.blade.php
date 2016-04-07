<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Designation</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $speakers as $user )
				<tr>
					<td width="200"><a href="{{ route('dashboard.users.show', $user->id) }}">{{ $user->name }}</a></td>
					<td>{{ $user->email }}</td>
					<td>{{ sprintf('%s at %s', $user->designation, $user->company) }}</td>
					<td class="right" width="100">
						<form method="POST" action="{{ route('dashboard.users.destroy', $user->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-primary">
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