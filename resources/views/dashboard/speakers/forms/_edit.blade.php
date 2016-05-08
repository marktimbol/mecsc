<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.speakers.update', $speaker->id) }}">
			{!! csrf_field() !!}
			{!! method_field('PUT') !!}
			@include('errors.form')
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="date">Name</label>
						<input type="text" name="name" class="form-control" value="{{ $speaker->name }}" />
					</div>

					<div class="form-group">
						<label for="date">E-Mail</label>
						<input type="email" name="email" class="form-control" value="{{ $speaker->email }}" />
					</div>

					<div class="form-group">
						<label for="date">Designation</label>
						<input type="text" name="designation" class="form-control" value="{{ $speaker->designation }}" />
					</div>

					<div class="form-group">
						<label for="date">Company</label>
						<input type="text" name="company" class="form-control" value="{{ $speaker->company }}" />
					</div>

					<div class="form-group">
						<label for="date">About</label>
						<textarea name="about" class="form-control" rows="10">
							{{ $speaker->about }}
						</textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>