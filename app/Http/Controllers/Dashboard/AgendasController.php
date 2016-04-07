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
use Mecsc\Contracts\UserInterface;

class AgendasController extends Controller
{
    protected $schedule;
    protected $agenda;
    protected $user;

	public function __construct(ScheduleInterface $schedule, AgendaInterface $agenda, UserInterface $user)
	{
        $this->schedule = $schedule;
        $this->agenda = $agenda;
        $this->user = $user;
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
        $availableSpeakers = $this->user->onlySpeakers()    
                            ->except($existingSpeakers)
                            ->get();

        JavaScript::put([
            'signedIn'  => Auth::check(),
            'agenda'    => $agenda,
            'speakers'  => $availableSpeakers
        ]);

        return view('dashboard.agendas.show', compact('agenda', 'schedules', 'speakers'));
    }

    public function destroy($agenda)
    {
        $deleted = $agenda->delete();
        
        if( ! $deleted )
        {
            flash()->error('Oops. Something happen. Please try again.');
            return redirect()->back();
        }

        flash()->success('Agenda has been successfully deleted!');
        return redirect()->route('dashboard.agendas.index');
    }

    public function addSpeaker($agenda, $speaker)
    {
        $agenda->speakers()->attach($speaker->id);

        $result = $this->agenda->find($agenda->id);
        return $result->speakers;
    }

    public function removeSpeaker($agenda, $speaker)
    {
        $agenda->speakers()->detach($speaker->id);

        $result = $this->agenda->find($agenda->id);
        return $result->speakers;
    }
}
