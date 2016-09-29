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