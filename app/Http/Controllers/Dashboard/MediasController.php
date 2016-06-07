<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Media;
use Illuminate\Http\Request;

class MediasController extends Controller
{
    public function index()
    {
    	$medias = Media::latest()->get();
    	return view('dashboard.medias.index', compact('medias'));
    }

    public function show($media)
    {
        return view('dashboard.medias.show', compact('media'));
    }

    public function store(Request $request)
    {
    	Media::create($request->all());

    	flash()->success('Success: A Media Partner has been successfully added.');
    	return redirect()->route('dashboard.medias.index');
    }

    public function edit($media)
    {
    	$medias = Media::latest()->get();
    	return view('dashboard.medias.edit', compact('media', 'medias'));
    }

    public function update(Request $request, $media)
    {
        $media->update($request->all());

        flash()->success('Success: Media Partner information has been successfully updated.');
        return redirect()->route('dashboard.medias.show', $media->id);
    }

    public function destroy($media)
    {
        $media->delete();

        flash()->success('Success: A Media Partner has been successfully removed.');
        return redirect()->route('dashboard.medias.index');
    }
}
