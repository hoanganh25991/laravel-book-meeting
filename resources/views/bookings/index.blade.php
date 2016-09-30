@extends('layouts.app')

@section('content')
    <ul>
    @foreach($bookings as $booking)
        <li>
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