<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.exhibitors.update', $exhibitor->id) }}">
			{!! csrf_field() !!}
			{!! method_field('PUT') !!}
			@include('errors.form')
			
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ $exhibitor->name }}" />
			</div>

			<div class="form-group">
				<label for="standNumber">Stand Number</label>
				<input type="text" name="standNumber" id="standNumber" class="form-control" value="{{ $exhibitor->standNumber }}" />
			</div>

			<div class="form-group">
				<label for="country">Country</label>
				<input type="text" name="country" id="country" class="form-control" value="{{ $exhibitor->country }}" />
			</div>

			<div class="form-group">
				<label for="website">Website URL</label>
				<input type="text" name="website" id="website" class="form-control" value="{{ $exhibitor->website }}" />
			</div>

			<div class="form-group">
				<label for="about">About</label>
				<textarea name="about" id="about" class="form-control" rows="10">
					{{ $exhibitor->about }}
				</textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>

		</form>
	</div>
</div>