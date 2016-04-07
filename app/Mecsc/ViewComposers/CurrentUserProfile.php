<?php

namespace Mecsc\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CurrentUserProfile
{
	public function compose(View $view)
	{
		$view->with('currentUser', Auth::user());
	}
}