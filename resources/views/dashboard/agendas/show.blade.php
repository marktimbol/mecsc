@extends('dashboard.layouts.app')

@section('content')

	<section class="content-header">
	    <h1>{{ $agenda->title }}</h1>
	    @include('dashboard._breadcrumbs')
	</section>

	<section class="content">
	    <div class="row">
		    <div class="col-md-4">
		    	@include('dashboard.agendas._create')
		    </div>
		    <div class="col-md-8">
		    	@include('dashboard.agendas._show')
		    </div>
	    </div>
	</section>
@endsection

@section('footer_scripts')
	<script src="{{ elixir('js/typeahead.js') }}"></script>
	<script src="/js/Speakers.js"></script>
@endsection