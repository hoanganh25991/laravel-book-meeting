@extends('layouts.app')

@section('content')
    <form action="/group/create" method="POST">
        <label for="">name</label>
        <input type="text" name="group[name]">
        <label for="">description</label>
        <input type="text" name="group[description]">
        <input type="submit" name="submit" value="submit">
    </form>
@endsection