@extends('layouts.app')

@section('content')
    <h1>Groups</h1>
    <small>enjoy or <a href="{{ url('group/create') }}">create new</a></small>
    <hr>
    <ul>
    @foreach($groups as $group)
        <li>{{ $group->name }}
            <div class="form-group">
                <div class="input-group">
                    <pre class="input-group">{{ $group }}</pre>
                    <div class="input-group-addon">
                        <button <?php
                                $attr = "disabled class='btn btn-default'";
                                if($group->user_status == 'join'){
                                    $attr = "class='btn btn-info'";
                                }
                                echo $attr;
                                ?>>
                            {{ $group->user_status }}
                        </button>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
@endsection