@extends('layouts.app')

@section('content')
    <ul>
    @foreach($bookings as $booking)
        <li>{{ $booking->description }}
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