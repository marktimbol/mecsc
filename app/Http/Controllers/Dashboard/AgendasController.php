<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateAgendaRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Mecsc\Contracts\AgendaInterface;
use Mecsc\Contracts\ScheduleInterface;
use Mecsc\Contracts\SpeakerInterface;

class AgendasController extends Controller
{
    protected $schedule;
    protected $agenda;
    protected $speaker;

	public function __construct(ScheduleInterface $schedule, AgendaInterface $agenda, SpeakerInterface $speaker)
	{
        $this->schedule = $schedule;
        $this->agenda = $agenda;
        $this->speaker = $speaker;
	}

    public function index()
    {
        $schedules = $this->schedule->all();
        return view('dashboard.agendas.index', compact('schedules'));
    }

    public function store(CreateAgendaRequest $request)
    {
        $stored = $this->agenda->store($request);

    	if( ! $stored)
        {
            flash()->error('Oops. Something happen. Please try again.');
            return redirect()->back()->withInput();
        }

        flash()->success('Agenda has been successfully saved!');
        return redirect()->route('dashboard.agendas.index');
    }

    public function show($agenda)
    {
        $schedules = $this->schedule->all();

        $existingSpeakers = $agenda->speakers->lists('id');

        JavaScript::put([
            'signedIn'  => Auth::check(),
            'agenda'    => $agenda
        ]);

        return view('dashboard.agendas.show', compact('agenda', 'schedules', 'speakers'));
    }

    public function destroy($agenda)
    {
        if( ! $this->agenda->delete($agenda) )
        {
            flash()->error('Oops. Something happen. Please try again.');
            return redirect()->back();
        }

        flash()->success('Agenda has been successfully deleted!');
        return redirect()->route('dashboard.agendas.index');
    }
}
