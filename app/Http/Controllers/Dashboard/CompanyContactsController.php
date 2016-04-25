<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyContactsController extends Controller
{
    public function store(Request $request, $company)
    {
    	return $company->addContact($request->contact_id);
    }

    public function destroy($company, $contact)
    {
    	return $company->removeContact($contact->id);
    }
}
