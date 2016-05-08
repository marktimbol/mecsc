@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>Speakers</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.speakers.forms._create')
			</div>

			<div class="col-md-8">
				@include('dashboard.speakers._all')
			</div>
		</div>
	</div>

@endsection