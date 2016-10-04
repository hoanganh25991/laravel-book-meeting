@extends('layouts.app')

@section('content')
    <h1>Groups</h1>
    <small>enjoy or <a href="{{ url('group/create') }}">create new</a></small>
    <hr>
    <ul id="groupList">
    @foreach($groups as $group)
        <li>{{ $group->name }}
            <div class="form-group">
                <div class="input-group">
                    <pre class="input-group">{{ $group }}</pre>
                    <a group-id="{{ $group->id }}"
                       group-name="{{ $group->name }}"
                    <?php
                        $attr = "class='my-addon btn btn-info'";
//                        if($group->user_status == 'join'){
//                            $attr .= "disabled";
//                        }
                        echo $attr;
                    ?>>{{ $group->user_status }}</a>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#groupList').on('click', 'a.my-addon', function(){
                let btn = $(this);
                let status = btn.text();
                console.log(status);
                if(status == 'pending'){
                    flash('Please wait for group-host accept it');
                    return;
                }
                let group_id = btn.attr('group-id');
                let group_name = btn.attr('group-name');
                console.log(group_id);
                $.post({
                    url: "{{ url('group/join') }}",
                    data: {
                        group_id: group_id
                    },
                    success: function(res){
                        console.log(res);
                        btn.text('pending');
                        flash(`Have ask <strong>${group_name}</strong>-host, please wait for accept`);
                    },
                    error: function(res){
                        console.log(res);
                    }
                });
            });
        });
    </script>
@endsection