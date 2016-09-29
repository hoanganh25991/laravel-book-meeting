@extends('layouts.app')

@section('content')
    <ul>
        @foreach($groups as $group)
            <li>{{ $group->name }}
                <ul class="usersList">
                    @foreach($group->users as $user)
                        <li>{{ $user->name }}
                            <button user-id="{{ $user->id }}" booking-id="{{ $booking_id }}">invite</button>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $('.usersList').on('click', 'button', function(){
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
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>
@endsection