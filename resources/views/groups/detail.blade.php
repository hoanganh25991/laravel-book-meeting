@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ $group->name }}</h1>
    <hr>
    <dl class="dl-horizontal">
        <dt>description</dt>
        <dd>{{ $group->description }}</dd>

        <dt>created by</dt>
        <dd>{{ $group->userCreated->name }}</dd>

        <dt>detail</dt>
        <dd>{{ $group }}</dd>
    </dl>
@endsection