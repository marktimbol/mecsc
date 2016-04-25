<div class="box box-primary">
	<div class="box-body">
		<form method="POST" action="{{ route('dashboard.schedules.store') }}">
			{!! csrf_field() !!}
			@include('errors.form')
			
			<div class="form-group">
				<label for="date">Date</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" name="eventDate" id="eventDate" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control" rows="10"></textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					Create Schedule
				</button>
			</div>

		</form>
	</div>
</div>