<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
        	{{ sprintf('Scheduled on %s %s @%s', $agenda->schedule->eventDate->toFormattedDateString(), $agenda->time, $agenda->venue) }}
        </h3>
    </div>

    <div class="box-body">
        <h3>Description</h3>
        {!! $agenda->description !!}

        <div id="Speakers" class="Speakers"></div>

    </div>
</div>