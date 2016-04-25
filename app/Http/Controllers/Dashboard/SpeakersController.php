<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateSpeakerRequest;
use App\User;
use Illuminate\Http\Request;
use Mecsc\Contracts\SpeakerInterface;

class SpeakersController extends Controller
{
	protected $speaker;

	public function __construct(SpeakerInterface $speaker)
	{
		$this->speaker = $speaker;
	}

    public function index()
    {
    	$speakers = $this->speaker->all();
    	return view('dashboard.speakers.index', compact('speakers'));
    }

    public function show($speaker)
    {
        return view('dashboard.speakers.show', compact('speaker'));
    }

    public function store(CreateSpeakerRequest $request)
    {
    	if( ! $this->speaker->store($request) )
        {
            return redirect()->back()->withInput();
        }

        flash()->success('Speaker has been successfully saved!');
        return redirect()->route('dashboard.speakers.index');
    }

    public function edit($speaker)
    {
        $speakers = $this->speaker->all();
        return view('dashboard.speakers.edit', compact('speaker', 'speakers'));
    }

    public function update($speaker, Request $request)
    {
        if( ! $this->speaker->update($speaker, $request) )
        {
            return redirect()->back()->withInput();
        }

        flash()->success('Speaker has been successfully updated!');
        return redirect()->route('dashboard.speakers.index');
    }

    public function destroy($speaker)
    {
        if( ! $this->speaker->delete($speaker) )
        {
            return redirect()->back();
        }

        flash()->success('Speaker has been successfully deleted!');
        return redirect()->route('dashboard.speakers.index');
    }
}
