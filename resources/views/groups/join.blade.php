@extends('layouts.app')

@section('content')
    <h1>Join Group</h1>
    <ul id="groupList" class="list-group">
        @foreach($groups as $group)
            <li class="list-group-item">
                <div class="input-group">
                    <a href='{{ url("group/{$group->id}") }}' class="h4"><strong>{{ $group->name }}</strong>-group</a>
                    <p class="small text-muted">{{ $group }}</p>
                    <a group-id="{{ $group->id }}" class="my-addon btn btn-info">{{ $group->btnTxt }}</a>
                </div>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $('#groupList').on('click', 'a.my-addon', function(){
            let btn = $(this);
            let status = btn.text();
            if(status == 'pending'){
                alert('Please wait for group-host accept it');
                return;
            }
            let group_id = btn.attr('group-id');
            console.log(group_id);
            $.post({
                url: '/group/join',
                data: {
                    group_id: group_id
                },
                success: function(res){
                    console.log(res);
                    btn.text('pending');
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection