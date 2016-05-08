@extends('dashboard.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{ sprintf("%s's Profile", $speaker->name) }}
            <small>
                <a href="{{ route('dashboard.speakers.edit', $speaker->id) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-pencil"></i>
                </a>
            </small>
        </h1>
        @include('dashboard._breadcrumbs')
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img 
                            class="profile-user-img img-responsive img-circle" 
                            src="/dist/img/user4-128x128.jpg" 
                            alt="" title="" />

                        <h3 class="profile-speakername text-center">
                            {{ $speaker->name }}
                        </h3>

                        <p class="text-muted text-center">
                            {{ $speaker->designation }} at {{ $speaker->company }}
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b>
                                <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b>
                                <a class="pull-right">543</a>
                            </li>

                        </ul>   
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-body">
                        <h4>Roles</h4>
                        <div id="UserRoles"></div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-body">
                        <strong>
                            <i class="fa fa-book margin-r-5"></i>
                            Education
                        </strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr />

                        <strong>
                            <i class="fa fa-map-marker margin-r-5"></i> Location
                        </strong>

                        <p class="text-muted">Malibu, California</p>
                        
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About</h3>
                    </div>
                    <div class="box-body">
                        {!! $speaker->about !!}
                    </div>
                </div>
            </div>  
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script src="/js/UserRoles.js"></script>
@endsection     