@extends('layouts.app')

@section('content')
    <pre>{{ $booking }}</pre>
    <ul>Invited users list
        @foreach($bookingUsers as $bookingUser)
            <li>
                <p>{{ $bookingUser->user->name }}</p>
                <p>{{ $bookingUser->user->email }}</p>
            </li>
        @endforeach
    </ul>
@endsection