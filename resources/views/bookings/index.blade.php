@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ Auth::user()->name }}'s Bookings</h1>
    <hr>
    <ul class="list-group bookingsList">
        @foreach($bookings as $booking)
            <li class="list-group-item">
                <div class="form-group">
                    <div class="input-group">
                        <a href='{{ url("booking/{$booking->id}") }}' class="h4">{{ $booking->description }}</a>
                        <p class="small text-muted">{{ $booking }}</p>
                        <p class="small text-muted">{{ $booking->created_by }}</p>
                        <a class="my-addon btn btn-info"
                           booking-id="{{ $booking->id }}"
                           booking-description="{{ $booking->description }}"
                        >{{ $booking->status }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.bookingsList').on('click', 'a.my-addon', function(){
                let btn = $(this);
                let booking_id = btn.attr('booking-id');
                let booking_desscription = btn.attr('booking-description');
                let status = btn.text();
                if(status == 'joined'){
                    flash(`You have joined <strong>${booking_desscription}</strong>`);
                    return;
                }
                $.post({
                    url: "{{ url('booking/verify') }}",
                    data:{
                        booking_id: booking_id
                    },
                    success: function(res){
                        console.log(res);
                        flash(`Joined into <strong>${booking_desscription}</strong>`);
                        btn.text('joined');
                    },
                    error: function(res){
                        console.log(res);
                        flash(`${res.msg}`);
                    }
                });
            });
        });
    </script>
@endsection

@section('out-box')
    <a href="{{ url('booking/create') }}" class="btn btn-info my-flow">
        <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
    </a>
@endsection

