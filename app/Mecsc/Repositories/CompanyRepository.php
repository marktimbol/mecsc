<?php

namespace Mecsc\Repositories;

use App\Company;

class CompanyRepository {

	public function all()
	{
		return Company::all();
	}

	public function latest()
	{
		return Company::latest()->get();
	}
	
	public function find($id)
	{
		return Company::findOrFail($id);
	}

	public function store($data)
	{
		return Company::create($data);
	}

	public function update($data, $company)
	{
		$company->fill($data);
		$company->save();
	}

	public function delete($company)
	{
		return $company->delete();
	}
}