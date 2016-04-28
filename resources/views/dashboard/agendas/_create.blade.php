<div class="box box-primary">
    <div class="box-body">
		<form method="POST" action="{{ route('dashboard.agendas.store') }}">
			{!! csrf_field() !!}
			@include('errors.form')

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Schedule</label>
						<select name="schedule_id" class="form-control">
							<option value=""></option>
							@foreach( $schedules as $schedule )
								<option value="{{ $schedule->id }}">{{ $schedule->eventDate }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="Title" />
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="venue">Venue</label>
						<input type="text" name="venue" id="venue" class="form-control" placeholder="Venue" />
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="time">Time</label>
						<input type="text" name="time" id="time" class="form-control" placeholder="Time" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" class="form-control" rows="10" placeholder="Description"></textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Create Agenda</button>
			</div>
		</form>
	</div>
</div>