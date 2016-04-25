<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mecsc\Contracts\UserInterface;
use JavaScript;

class UsersController extends Controller
{
	protected $user;

	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

    public function index()
    {
    	$users = $this->user->all();
    	return view('dashboard.users.index', compact('users'));
    }

    public function show($user)
    {        
        JavaScript::put([
            'signedIn'  => Auth::check(),
            'user'  => $user,
            'roles' => Role::all()
        ]);

        return view('dashboard.users.show', compact('user'));
    }

    public function store(CreateUserRequest $request)
    {
    	if( ! $this->user->store($request) )
        {
            return redirect()->back()->withInput();
        }

        flash()->success('User has been successfully saved!');
        return redirect()->route('dashboard.users.index');
    }

    public function edit($user)
    {
        $users = $this->user->all();
        return view('dashboard.users.edit', compact('user', 'users'));
    }

    public function update($user, Request $request)
    {
        if( ! $this->user->update($user, $request) )
        {
            return redirect()->back()->withInput();
        }

        flash()->success('User record has been successfully updated!');
        return redirect()->route('dashboard.users.show', $user->id);
    }

    public function destroy($user)
    {
        if( ! $this->user->delete($user) )
        {
            return redirect()->back();
        }

        flash()->success('User has been successfully deleted!');
        return redirect()->route('dashboard.users.index');
    }
}
