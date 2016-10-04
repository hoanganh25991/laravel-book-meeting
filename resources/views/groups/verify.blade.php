@extends('layouts.app')

@section('content')
    <ul class="list-group">
    @foreach($groups as $group)
        <li class="list-group-item">
            <h4><strong>{{ $group->name }}</strong>-group</h4>
            {{--user list--}}
            <div class="col-md-offset-1 usersList">
                @foreach($group->users as $user)
                    <div class="form-group">
                        <div class="input-group">
                            <span class="avatar-addon">
                                <img src="{{ url('images/new-user-image-default.png') }}" alt="avatar" class="avatar img-thumbnail">
                            </span>
                            <p class="form-control">{{ $user->name }}</p>
                            <a user-id="{{ $user->id }}"
                               user-name="{{ $user->name }}"
                               group-id="{{ $group->id }}"
                               group-name="{{ $group->name }}"
                               class="my-addon btn btn-info"
                            >{{ $user->group_status }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </li>
    @endforeach
    </ul>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        $('.usersList').on('click', 'a.my-addon', function(){
            let btn = $(this);
            let user_id = btn.attr('user-id');
            let user_name = btn.attr('user-name');

            let group_id = btn.attr('group-id');
            let group_name = btn.attr('group-name');

            console.log(user_id);
            let status = btn.text();
            if(status == 'joined'){
                flash(`${user_name} has joined <strong>${group_name}</strong>`);
                return;
            }
            $.post({
                url: "{{ url('group/verify') }}",
                data: {
                    user_id: user_id,
                    group_id: group_id
                },
                success: function(res){
                    console.log(res);
                    flash(`${res.msg}`);
                    btn.text('joined');
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection