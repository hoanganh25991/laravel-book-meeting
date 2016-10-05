@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <h1 class="panel-heading">Booking List</h1>
        <div class="panel-body">
            <div id="wrapper">
                <div id="myScheduler"></div>
            </div>
        </div>
        <script src="{{ url('js/aui-min.js') }}"></script>
        <script>
            console.log(events);
            YUI().use(
                'aui-scheduler',
                function(Y) {
//                    window.events = events;
                    let agendaView = new Y.SchedulerAgendaView();
                    let dayView = new Y.SchedulerDayView();
                    let weekView = new Y.SchedulerWeekView();
                    let monthView = new Y.SchedulerMonthView();

                    let auiEvents = events.map(function(event){
                        let tmp = {};
                        tmp.content = event.description;
                        tmp.startDate = new Date(event.start_date);
                        tmp.endDate = new Date(event.end_date);
                        return tmp;
                    });

                    window.auiEvents = auiEvents;

                    let scheduler = new Y.Scheduler(
                        {
                            activeView: weekView,
                            boundingBox: '#myScheduler',
                            date: new Date(),
                            items: auiEvents,
                            render: true,
                            views: [dayView, weekView, monthView, agendaView]
                        }
                    );

                    window.scheduler = scheduler;
                }
            );
        </script>
    </div>
    <div class="panel panel-default">
        <h1 class="panel-heading">Pending Bookings</h1>
        <div class="panel-body">
            <ul class="list-group bookingsList">
                @foreach($verifyBookings as $booking)
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
        </div>
    </div>
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

