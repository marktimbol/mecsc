<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
			{!! csrf_field() !!}
			{!! method_field('PUT') !!}
			@include('errors.form')
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="date">Name</label>
						<input type="text" name="name" class="form-control" value="{{ $user->name }}" />
					</div>

					<div class="form-group">
						<label for="date">E-Mail</label>
						<input type="email" name="email" class="form-control" value="{{ $user->email }}" />
					</div>

					<div class="form-group">
						<label for="date">Designation</label>
						<input type="text" name="designation" class="form-control" value="{{ $user->designation }}" />
					</div>

					<div class="form-group">
						<label for="date">Company</label>
						<input type="text" name="company" class="form-control" value="{{ $user->company }}" />
					</div>

					<div class="form-group">
						<label for="date">About</label>
						<textarea name="about" class="form-control" rows="10">
							{{ $user->about }}
						</textarea>
					</div>

					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">Update User</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>