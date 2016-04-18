<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateCompanyRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use Mecsc\Repositories\CompanyRepository;
use Mecsc\Repositories\UserRepository;

class CompaniesController extends Controller
{
	protected $company;
    protected $user;

	public function __construct(CompanyRepository $company, UserRepository $user)
	{
		$this->company = $company;
        $this->user = $user;
	}

    public function index()
    {
    	$companies = $this->company->latest();
    	return view('dashboard.companies.index', compact('companies'));
    }

    public function show($company)
    {
        JavaScript::put([
            'signedIn'  => Auth::check(),
            'company'  => $company,
            'roles' => Role::all(),
            'users' => $this->user->all(),
        ]);
        return view('dashboard.companies.show', compact('company'));
    }

    public function store(CreateCompanyRequest $request)
    {
    	$this->company->store($request->all());

        flash()->success('Company has been successfully created.');
        return redirect()->route('dashboard.companies.index');
    }

    public function edit($company)
    {
        $companies = $this->company->latest();
    	return view('dashboard.companies.edit', compact('company', 'companies'));
    }

    public function update(Request $request, $company)
    {
        $this->company->update($request->all(), $company);

        flash()->success('Company has been successfully updated.');
        return redirect()->route('dashboard.companies.index');
    }

    public function destroy($company)
    {
    	$this->company->delete($company);

        flash()->success('Company has been successfully deleted.');
        return redirect()->route('dashboard.companies.index');
    }
}
