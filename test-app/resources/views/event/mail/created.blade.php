<h5>Event Created</h5>

<div class="my-3">
	<div class="card" id="event-card">
		<div class="card-body">
			<h5 class="card-title" id="event-name">{{ $event->name }}</h5>
			<h6 class="card-subtitle mb-2 text-muted" id="event-id">{{ $event->id }}</h6>
			<div class="card-text">
				<p id="event-content">{{ $event->slug }}</p>
			</div>
		</div>
		<div class="card-footer text-muted">
			<div><strong>Start at: </strong><span id="start-at">{{ $event->startAt }}</span></div>
			<div><strong>End at: </strong><span id="end-at">{{ $event->endAt }}</span></div>
		</div>
	</div>
</div>