<?php

namespace App\Http\Repositories;

use Carbon\Carbon;
use App\Models\Event;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Contracts\EventContract;

class EventRepository extends BaseRepository implements EventContract
{
	/** @var Event */
	protected $event;

	public function __construct(Event $event)
	{
		parent::__construct($event);
		$this->event = $event;
	}

	public function active()
	{
		return $this->event
					->where('startAt', '=', Carbon::now()->format('Y-m-d'))
					->orWhere('endAt', '=', Carbon::now()->format('Y-m-d'))
					->get();
	}
}
