@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="panel panel-default">
                <h1 class="panel-heading">Home Page</h1>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <img src="{{ url('images/new-user-image-default.png') }}"
                                 alt="avatar"
                                 class="img-thumbnail">
                            <div>
                                <h4><strong>{{ $user->name }}</strong></h4>
                                <h4>{{ $user->email }}</h4>
                                <a href='{{ url("user/{$user->id}/edit}") }}' class="btn btn-info btn-block">Edit profile</a>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="panel-body">
                                <p><a href="{{ url('booking') }}">Review Your Bookings</a></p>
                                <p><a href="{{ url('group') }}">Review Your Group</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{--</div>--}}
    {{--</div>--}}

@endsection
