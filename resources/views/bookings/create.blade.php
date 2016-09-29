@extends('layouts.app')

@section('content')
    <form action="/booking/create" method="POST">
    	<label for="bookingDate">Date:</label>
    	<input type="date" name="date" id="bookingDate">
    	<label for="bookingDate">Room:</label>
    	<input type="number" name="room" id="bookingRoom">
        <input type="submit" name="submitBooking" value="submit">
    </form>
@endsection