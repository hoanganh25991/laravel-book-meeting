@extends('layouts.app')

@section('content')
    <h1>All Rooms</h1>
    <ul class="list-group">
        @foreach($rooms as $room)
            <li class="list-group-item">
                {{ $room->toJson(JSON_PRETTY_PRINT) }}
            </li>
        @endforeach
    </ul>
@endsection