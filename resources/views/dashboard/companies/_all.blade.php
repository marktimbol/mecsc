<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Stand Number</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $companies as $company )
				<tr>
					<td>
						<a href="{{ route('dashboard.companies.show', $company->id) }}">
							{{ $company->name }}
						</a>
					</td>
					<td>{{ $company->standNumber }}</td>
					<td class="right" width="100">
						<form method="POST" action="{{ route('dashboard.companies.destroy', $company->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('dashboard.companies.edit', $company->id) }}" class="btn btn-primary">
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