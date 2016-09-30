@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <h1>Invite</h1>
    <ul class="list-group">
        @foreach($groups as $group)
            <li class="list-group-item">
                <h4><strong>{{ $group->name }}</strong>-group</h4>
                <div class="col-md-offset-1">
                    @foreach($group->users as $user)
                        <div class="input-group usersList">
                            {{--<span class="input-group-addon">--}}
                            <span class="avatar-addon">
                                {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                                <img src="{{ url('images/new-user-image-default.png') }}" alt="avatar" class="avatar img-thumbnail">
                            </span>
                            <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                            <a user-name="{{ $user->name }}" user-id="{{ $user->id }}" booking-id="{{ $booking_id }}" class="my-addon btn btn-info ">invite</a>
                        </div>
=======
    <ul class="list-group">
        @foreach($groups as $group)
            <li class="list-group-item">
                <h4><strong>{{ $group->name }}</strong></h4>
                <div class="col-md-offset-1">
                    @foreach($group->users as $user)
                        <form>
                            <div class="input-group usersList">
                                <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                                <a user-id="{{ $user->id }}" booking-id="{{ $booking_id }}" class="my-addon btn btn-info ">invite</a>
                            </div>
                        </form>
>>>>>>> 7fda3c4c05799de3711d7e13c5e9472bc39cfedf
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $('.usersList').on('click', 'a.my-addon', function(){
            let btn = $(this);
//            console.log(btn.parent());
            let userList = btn.parent();
            let user_id = btn.attr('user-id');
            let booking_id = btn.attr('booking-id');
            console.log(user_id);

            //flash message prepare
            //on success DO IT
            let flashMsg = document.querySelector('div.alert');
            let user_name = btn.attr('user-name');
            $.post({
                url: '{{ url("booking/{$booking_id}/invite") }}',
                data: {
                    user_id: user_id,
                    booking_id: booking_id
                },
                success: function(res){
                    console.log(res);
<<<<<<< HEAD
                    flashMsg.innerText = `Invited ${user_name}`;
                    flashMsg.className = 'alert alert-info';
                    $(flashMsg).fadeIn();
                    $(flashMsg).delay(500).fadeOut();
                    userList.delay(500).fadeOut();
=======
                    {{--window.location.href = '{{ url("booking/{$booking_id}") }}';--}}
>>>>>>> 7fda3c4c05799de3711d7e13c5e9472bc39cfedf
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection