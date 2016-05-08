<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mecsc\Contracts\ScheduleInterface;

class SchedulesController extends Controller
{
	protected $schedule;

	public function __construct(ScheduleInterface $schedule)
	{
		$this->schedule = $schedule;
	}

    public function index()
    {
    	return $this->schedule->all();
    }

    public function show($schedule)
    {
    	return $schedule;
    }
}
