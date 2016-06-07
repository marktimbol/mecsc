<?php

namespace App\Http\Controllers\Api;

use App\Exhibitor;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ExhibitorsController extends Controller
{
    public function index()
    {
    	return Exhibitor::latest()->get();
    }
}
