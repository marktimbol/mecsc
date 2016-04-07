@extends('dashboard.layouts.app')

@section('header_styles')
	<link rel="stylesheet" href="{{ elixir('css/datepicker.css') }}" />
@endsection

@section('content')
    <section class="content-header">
        <h1>Schedules</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.schedules.forms._create')
			</div>
			<div class="col-md-8">
				@include('dashboard.schedules._all')
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')
	<script src="{{ elixir('js/datepicker.js') }}"></script>
@endsection