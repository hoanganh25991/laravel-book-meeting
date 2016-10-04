@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ Auth::user()->name }}'s Bookings</h1>
    <hr>
    <ul class="list-group">
    @foreach($bookings as $booking)
        <li class="list-group-item">
            <div class="form-group">
                <div class="input-group">
                    <a href='{{ url("booking/{$booking->id}") }}' class="h4">{{ $booking->description }}</a>
                    <p class="small text-muted">{{ $booking }}</p>
                    <p class="small text-muted">{{ $booking->created_by }}</p>
                    <a href='{{ url("booking/invite/verify") }}'
                       class="my-addon btn btn-info"
                       booking-id="{{ $booking->id }}"
                    >{{ $booking->status }}</a>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
@endsection

@section('out-box')
    <a href="{{ url('booking/create') }}" class="btn btn-info my-flow">
        <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
    </a>
@endsection

