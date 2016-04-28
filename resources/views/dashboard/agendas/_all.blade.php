<div class="box box-primary">
    <div class="box-body">
        <ul class="timeline">
        	@foreach( $schedules as $schedule )
                <li class="time-label">
                    <span class="bg-green">
                        {{ $schedule->eventDate->toFormattedDateString() }}
                    </span>
                </li>

                @foreach( $schedule->agendas as $agenda )
                    <li>
                        <i class="fa fa-user bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ $agenda->time }}</span>

                            <h3 class="timeline-header">
                            	<a href="{{ route('dashboard.agendas.show', $agenda->id) }}">
                            		{{ $agenda->title }}
                            	</a>
                                <br /><br />
                                <p class="text-muted">
                                    Venue: {{ $agenda->venue }}
                                </p>
                            </h3>

                            <div class="timeline-body">
                                {!! str_limit($agenda->description, 200) !!}
                            </div>

                            <div class="timeline-footer">
                                <label class="text-muted">Speakers:</label>
                            	@foreach( $agenda->speakers as $speaker )
                            		<span class="label label-info">
                            			<a href="{{ route('dashboard.users.show', $speaker->id) }}">
                            				{{ $speaker->name }}
                            			</a>
                            		</span>
                            		&nbsp;
                            	@endforeach
                            </div>
                        </div>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>