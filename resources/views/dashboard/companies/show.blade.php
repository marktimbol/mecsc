@extends('dashboard.layouts.app')

@section('content')
    <section class="content-header">
        <h1>Company: {{ $company->name }}</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.companies.forms._create')
			</div>
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-body">
						<ul class="list-group">
							<li class="list-group-item">
								<strong>Name: {{ $company->name }}</strong></li>
							</li>
							<li class="list-group-item">
								<strong>Stand Number:</strong> {{ $company->standNumber }}
							</li>
							<li class="list-group-item">
								<h4>Roles</h4>
								<div id="CompanyRoles"></div>
							</li>
						</ul>	


						<h3>Description</h3>
						{!! $company->description !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')
    <script src="/js/CompanyRoles.js"></script>
@endsection     