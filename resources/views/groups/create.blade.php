@extends('layouts.app')

@section('content')
    <h1>New Group</h1>
    <form action="{{ url('group/create') }}" method="POST">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">name</span>
                <input type="text" name="group[name]" class="form-control">
            </div>
            <small class="form-text text-muted">Group name</small>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">description</span>
                <input type="text" name="group[description]" class="form-control">
            </div>
            <small class="form-text text-muted">Group description</small>
        </div>

        <diV class="form-group">
            <button class="btn btn-info pull-right">Create</button>
        </diV>
    </form>
@endsection