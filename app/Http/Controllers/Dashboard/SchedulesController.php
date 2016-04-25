<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateScheduleRequest;
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
    	$schedules = $this->schedule->all();
    	return view('dashboard.schedules.index', compact('schedules'));
    }

    public function store(CreateScheduleRequest $request)
    { 
    	if( ! $this->schedule->store($request) )
        {
            return redirect()->back()->withInput();
        }

        flash()->success('Schedule has been successfully saved!');
        return redirect()->route('dashboard.schedules.index');
    }

    public function destroy($schedule)
    {
        if( ! $this->schedule->delete($schedule) )
        {
            flash()->success('Goood goood. You are now close to the dark side.');
            return redirect()->back();
        }

        flash()->success('Schedule has been successfully deleted!');
        return redirect()->route('dashboard.schedules.index');
    }
}
