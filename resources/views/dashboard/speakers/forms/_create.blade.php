<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.speakers.store') }}">
			{!! csrf_field() !!}
			@include('errors.form')
				
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="date">Name</label>
						<input type="text" name="name" class="form-control" value="{{ old('name') }}" />
					</div>

					<div class="form-group">
						<label for="date">Designation</label>
						<input type="text" name="designation" class="form-control" value="{{ old('designation') }}" />
					</div>

					<div class="form-group">
						<label for="date">Company</label>
						<input type="text" name="company" class="form-control" value="{{ old('company') }}" />
					</div>

					<div class="form-group">
						<label for="date">About</label>
						<textarea name="about" class="form-control" rows="10">
							{{ old('about') }}
						</textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create Speaker</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>