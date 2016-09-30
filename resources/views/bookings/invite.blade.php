@extends('layouts.app')

@section('content')
    <ul class="list-group">
        @foreach($groups as $group)
            <li class="list-group-item">
                <h4><strong>{{ $group->name }}</strong></h4>
                <div class="col-md-offset-1">
                    @foreach($group->users as $user)
                        <div class="input-group usersList">
                            <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                            <a user-id="{{ $user->id }}" booking-id="{{ $booking_id }}" class="my-addon btn btn-info ">invite</a>
                        </div>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $('.usersList').on('click', 'a', function(){
            let btn = $(this);
            let user_id = btn.attr('user-id');
            let booking_id = btn.attr('booking-id');
            console.log(user_id);
            $.post({
                url: '{{ url("booking/{$booking_id}/invite") }}',
                data: {
                    user_id: user_id,
                    booking_id: booking_id
                },
                success: function(res){
                    console.log(res);
                    {{--window.location.href = '{{ url("booking/{$booking_id}") }}';--}}
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection