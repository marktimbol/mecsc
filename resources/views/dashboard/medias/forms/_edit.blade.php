<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.medias.update', $media->id) }}">
			{!! csrf_field() !!}
			{!! method_field('PUT') !!}
			@include('errors.form')
			
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ $media->name }}" />
			</div>

			<div class="form-group">
				<label for="website">Website URL</label>
				<input type="text" name="website" id="website" class="form-control" value="{{ $media->website }}" />
			</div>

			<div class="form-group">
				<label for="about">About</label>
				<textarea name="about" id="about" class="form-control" rows="10">
					{{ $media->about }}
				</textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>

		</form>
	</div>
</div>