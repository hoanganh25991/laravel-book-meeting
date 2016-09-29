@extends('layouts.app')

@section('content')
    <ul id="groupList">
        @foreach($groups as $group)
            <li>{{ $group->name }}
                <button class="joinGroup" group-id="{{ $group->id }}">{{ $group->btnTxt }}</button>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $('#groupList').on('click', 'button', function(){
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