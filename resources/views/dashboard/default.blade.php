@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Page Title
            <small></small>
        </h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Subtitle</h3>
                </div>

                <div class="box-body">

                </div>
            </div>
        </div>
    </section>

@endsection
