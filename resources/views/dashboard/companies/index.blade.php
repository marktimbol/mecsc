@extends('dashboard.layouts.app')

@section('content')
    <section class="content-header">
        <h1>Companies</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.companies.forms._create')
			</div>
			<div class="col-md-8">
				@include('dashboard.companies._all')
			</div>
		</div>
	</div>
@endsection