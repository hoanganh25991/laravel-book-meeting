{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<h1 class="text-center">{{ Auth::user()->name }}'s Bookings</h1>--}}
    {{--<hr>--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($bookings as $booking)--}}
        {{--<li class="list-group-item">--}}
            {{--<div class="input-group">--}}
                {{--<h4>--}}
                    {{--<a href='{{ url("booking/{$booking->id}") }}'>{{ $booking->description }}</a>--}}
                {{--</h4>--}}
                {{--<p class="small text-muted">{{ $booking }}</p>--}}
                {{--<span class="input-group-addon btn btn-info bg-info">invite</span>--}}
                {{--<div class="input-group-btn">--}}
                    {{--<a href='{{ url("booking/{$booking->id}/invite") }}' class="btn btn-info">invite</a>--}}
                {{--</div>--}}
                {{--<a href='{{ url("booking/{$booking->id}/invite") }}' class="my-addon btn btn-info ">invite</a>--}}
                {{--<a href='{{ url("booking/{$booking->id}/invite") }}' class="input-group-addon btn btn-info ">invite</a>--}}
            {{--</div>--}}
        {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
{{--@endsection--}}

{{--@section('out-box')--}}
    {{--<a href="{{ url('booking/create') }}" class="btn btn-info my-flow">--}}
        {{--<i class="fa fa-pencil fa-2x" aria-hidden="true"></i>--}}
    {{--</a>--}}
{{--@endsection--}}
@extends('layouts.app')

@section('content')
    <ul>
        @foreach($groups as $group)
            <li>{{ $group->name }}
                <pre>{{ $group }}</pre>
            </li>
        @endforeach
    </ul>
@endsection

