@extends('layouts.app')

@section('content')
    <ul>
    @foreach($bookings as $booking)
        <li>{{ $booking->description }}
            <pre>{{ $booking }}</pre>
            <button>invite</button>
        </li>
    @endforeach
    </ul>
@endsection