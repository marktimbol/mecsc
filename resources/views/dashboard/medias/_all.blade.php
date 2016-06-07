<div class="box box-primary">
	<div class="box-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $medias as $media )
				<tr>
					<td>
						<a href="{{ route('dashboard.medias.show', $media->id) }}">
							{{ $media->name }}
						</a>
					</td>
					<td class="right" width="100">
						<form method="POST" action="{{ route('dashboard.medias.destroy', $media->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('dashboard.medias.edit', $media->id) }}" class="btn btn-primary">
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