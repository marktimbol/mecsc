<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mecsc\Repositories\CompanyRepository;

class CompanyRolesController extends Controller
{
	protected $company;

	public function __construct(CompanyRepository $company)
	{
		$this->company = $company;
	}

    public function store(Request $request, $company)
    {	    	
    	$company->addRole($request->role_id);

    	$company = $this->company->find($company->id);
    	return $company->roles;
    }

    public function destroy($company, $role)
    {
    	$company->removeRole($role->id);
    	
    	$company = $this->company->find($company->id);
    	return $company->roles;
    }
}
