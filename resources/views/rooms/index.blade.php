@extends('layouts.app')

@section('content')
    <ul>
        @foreach($rooms as $room)
            <li>
                <pre>{{ $room->toJson(JSON_PRETTY_PRINT) }}</pre>
            </li>
        @endforeach
    </ul>
@endsection