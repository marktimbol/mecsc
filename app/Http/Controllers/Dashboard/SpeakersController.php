<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Mecsc\Contracts\UserInterface;
use Mecsc\Roles\Speaker;

class SpeakersController extends Controller
{
	protected $speaker;

	public function __construct(UserInterface $speaker)
	{
		$this->speaker = $speaker;
	}

    public function index()
    {
    	$speakers = (new Speaker)->all();
    	return view('dashboard.speakers.index', compact('speakers'));
    }

    public function show($speaker)
    {        
        JavaScript::put([
            'signedIn'  => Auth::check(),
            'user'  => $speaker,
            'roles' => Role::all()
        ]);

        return view('dashboard.speakers.show', compact('speaker'));
    }

    public function store(CreateUserRequest $request)
    {
    	$user = $this->speaker->store($request);
    	(new Speaker)->add($user);

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

        flash()->success('Speaker record has been successfully updated!');
        return redirect()->route('dashboard.speakers.show', $speaker->id);
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
