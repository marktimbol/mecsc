@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small></small>
        </h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">

        @include('dashboard._statistics')
    
        <div class="row">
        
        </div>
    
    </section>

@endsection
