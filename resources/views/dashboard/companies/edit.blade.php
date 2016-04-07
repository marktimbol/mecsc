@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>Edit Company</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
        	<div class="col-md-4">
	        	@include('dashboard.companies.forms._edit')
        	</div>

			<div class="col-md-8">
				@include('dashboard.companies._all')
			</div>
        </div>
    </section>

@endsection
