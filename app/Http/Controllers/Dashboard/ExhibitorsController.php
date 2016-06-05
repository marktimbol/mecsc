<?php

namespace App\Http\Controllers\Dashboard;

use App\Exhibitor;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ExhibitorsController extends Controller
{
    public function index()
    {
    	$exhibitors = Exhibitor::latest()->get();
    	return view('dashboard.exhibitors.index', compact('exhibitors'));
    }

    public function show($exhibitor)
    {
        return view('dashboard.exhibitors.show', compact('exhibitor'));
    }

    public function store(Request $request)
    {
    	Exhibitor::create($request->all());

    	flash()->success('Success: An Exhibitor has been successfully added.');
    	return redirect()->route('dashboard.exhibitors.index');
    }

    public function edit($exhibitor)
    {
    	$exhibitors = Exhibitor::latest()->get();
    	return view('dashboard.exhibitors.edit', compact('exhibitor', 'exhibitors'));
    }

    public function update(Request $request, $exhibitor)
    {
        $exhibitor->update($request->all());

        flash()->success('Success: Exhibitor information has been successfully updated.');
        return redirect()->route('dashboard.exhibitors.show', $exhibitor->id);
    }

    public function destroy($exhibitor)
    {
        $exhibitor->delete();

        flash()->success('Success: An exhibitor has been successfully removed.');
        return redirect()->route('dashboard.exhibitors.index');
    }
}
