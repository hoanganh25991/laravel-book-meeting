@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <h1 class="panel-heading">Booking Detail</h1>
                @include('partials.booking-info')
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <h1 class="panel-heading">Invited Users</h1>
                <div class="panel-body">
                    @foreach($users as $user)
                        <div class="form-group">
                            <div class="input-group usersList">
                        <span class="avatar-addon">
                            <img src="{{ url('images/new-user-image-default.png') }}" alt="avatar" class="avatar img-thumbnail">
                        </span>
                                <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                                <a user-name="{{ $user->name }}"
                                   user-id="{{ $user->id }}"
                                   booking-id="{{ $booking->id }}"
                                   class="my-addon btn btn-info "
                                >{{ $user->booking_status }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection