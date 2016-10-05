@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <h1 class="panel-heading">Rooms</h1>
        <div class="panel-body">
            @foreach($rooms as $room)
                <div class="panel panel-default">
                    <h4 class="panel-heading">{{ $room->name }}</h4>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Address</dt>
                            <dd>{{ $room->address }}</dd>

                            <dt>Locate</dt>
                            <dd>{{ $room->locate }}</dd>
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection