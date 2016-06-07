<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Media;
use Illuminate\Http\Request;

class MediasController extends Controller
{
    public function index()
    {
    	return Media::latest()->get();
    }
}
