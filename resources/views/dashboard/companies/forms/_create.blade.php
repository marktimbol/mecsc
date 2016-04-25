<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.companies.store') }}">
			{!! csrf_field() !!}
			@include('errors.form')
			
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" />
			</div>

			<div class="form-group">
				<label for="standNumber">Stand Number</label>
				<input type="text" name="standNumber" id="standNumber" class="form-control" value="{{ old('standNumber') }}" />
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control" rows="10"></textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					Create Company
				</button>
			</div>

		</form>
	</div>
</div>