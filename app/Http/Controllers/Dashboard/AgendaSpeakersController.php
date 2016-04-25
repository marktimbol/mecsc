<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mecsc\Contracts\AgendaInterface;

class AgendaSpeakersController extends Controller
{
	protected $agenda;

	public function __construct(AgendaInterface $agenda)
	{
		$this->agenda = $agenda;
	}

    public function store(Request $request, $agenda)
    {
    	$agenda->addSpeaker($request->speaker_id);

        $result = $this->agenda->find($agenda->id);
        return $result->speakers;
    }

    public function destroy($agenda, $speaker)
    {
    	$agenda->removeSpeaker($speaker->id);

        $result = $this->agenda->find($agenda->id);
        return $result->speakers;
    }
}
