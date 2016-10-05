@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <h1 class="panel-heading">Invite team members</h1>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($groups as $group)
                    <li class="list-group-item">
                        <h4><strong>{{ $group->name }}</strong>-group</h4>
                        <div class="col-md-offset-1">
                            @foreach($group->users as $user)
                                <div class="form-group">
                                    <div class="input-group usersList">
                                        <span class="avatar-addon">
                                            <img src="{{ url('images/new-user-image-default.png') }}"
                                                 alt="avatar"
                                                 class="avatar img-thumbnail">
                                        </span>
                                        <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                                        <a user-name="{{ $user->name }}"
                                           user-id="{{ $user->id }}"
                                           booking-id="{{ $booking_id }}"
                                           class="my-addon btn btn-info "
                                        >{{ $user->booking_status }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        if(groups_length == 0){
            console.log('groups_length', 0);
            let html = `<p class='small pull-right' onclick="$('.alert').addClass('animated fadeOutRight');">
                            <i class='fa fa-times'></i>
                        </p>
                        <p>Oops, look like you haven't joined any group</p>
                        <ul class='small'>
                            <li><a href='{{ url('group') }}'>Find your group</a></li>
                            <li><a href='{{ url('group/create') }}'>create new one</a></li>
                        </ul>`;
            flash(html, 'important');
        }
        $('.usersList').on('click', 'a.my-addon', function(){
            let btn = $(this);
//            console.log(btn.parent());
            let user_id = btn.attr('user-id');
            let user_name = btn.attr('user-name');

            let booking_id = btn.attr('booking-id');
            console.log(user_id);

            //flash message prepare
            //on success DO IT
            let status = btn.text();
            if(status == 'joined'){
                flash(`<strong>${user_name}</strong> has joined`);
                return;
            }
            if(status == 'pending'){
                console.log(status);
                flash(`Waiting for <strong>${user_name}</strong> accepted`);
                return;
            }
            $.post({
                url: '{{ url("booking/{$booking_id}/invite") }}',
                data: {
                    user_id: user_id,
                    booking_id: booking_id
                },
                success: function(res){
                    console.log(res);
                    flash(`Invite sent to <strong>${user_name}</strong>`);
                    btn.text('pending');
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection