@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>Speakers</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.users.forms._create', ['role_id' => 4])
			</div>

			<div class="col-md-8">
				@include('dashboard.speakers._all')
			</div>
		</div>
	</div>

@endsection