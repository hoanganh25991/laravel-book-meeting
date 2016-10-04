@extends('layouts.app')

@section('content')
    <h1 class="text-center">Invite Team Member</h1>
    <hr>
    <ul class="list-group">
        @foreach($groups as $group)
            <li class="list-group-item">
                <h4><strong>{{ $group->name }}</strong>-group</h4>
                <div class="col-md-offset-1">
                    @foreach($group->users as $user)
                        <div class="form-group">
                            <div class="input-group usersList">
                                {{--<span class="input-group-addon">--}}
                                <span class="avatar-addon">
                                {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                                    <img src="{{ url('images/new-user-image-default.png') }}" alt="avatar" class="avatar img-thumbnail">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
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