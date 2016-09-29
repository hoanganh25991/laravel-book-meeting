@extends('layouts.app')

@section('content')
    <ul>
    @foreach($bookings as $booking)
        <li>{{ $booking->description }}
            <pre>{{ $booking }}</pre>
        </li>
    @endforeach
    </ul>
@endsection