@extends('dashboard.layouts.app')

@section('content')
    <section class="content-header">
        <h1>{{ $media->name }}</h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
			<div class="col-md-4">
				@include('dashboard.medias.forms._create')
			</div>
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-body">
						<ul class="list-group">
							<li class="list-group-item">
								<strong>Name: {{ $media->name }}</strong></li>
							</li>
							<li class="list-group-item">
								<strong>Website Url:</strong> 
								<a href="{{ $media->website }}" target="_blank">
									{{ $media->website }}
								</a>
							</li>
						</ul>	
						<h3>About</h3>
						{!! $media->about !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection