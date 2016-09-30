@extends('layouts.app')

@section('content')
    <h1 class="page-header">{{ Auth::user()->name }}'s Bookings</h1>
    <ul class="list-group">
    @foreach($bookings as $booking)
        <li class="list-group-item">
            <a href='{{ url("booking/{$booking->id}") }}'>{{ $booking->description }}</a>
            <pre>{{ $booking }}</pre>
            <button>
                <a href='{{ url("booking/{$booking->id}/invite") }}'>invite</a>
            </button>
        </li>
    @endforeach
    </ul>
    <button>
        <a href="{{ url('booking/create') }}">create</a>
    </button>
@endsection