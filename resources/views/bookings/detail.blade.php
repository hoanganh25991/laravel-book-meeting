@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ $booking->description }}</h1>
    <hr>
    <p>{{ $booking }}</p>
    <ul>Invited users list
        @foreach($bookingUsers as $bookingUser)
            <li>
                <p>{{ $bookingUser->user->name }}</p>
                <p>{{ $bookingUser->user->email }}</p>
            </li>
        @endforeach
    </ul>
@endsection