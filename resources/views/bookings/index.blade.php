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
            let scheduler;
            YUI().use(
                'aui-scheduler',
                function(Y) {
//                    window.events = events;
                    let agendaView = new Y.SchedulerAgendaView();
                    let dayView = new Y.SchedulerDayView();
                    let weekView = new Y.SchedulerWeekView();
                    let monthView = new Y.SchedulerMonthView();
                    var eventRecorder = new Y.SchedulerEventRecorder();
                    window.eventRecorder = eventRecorder;
//                    eventRecorder._attrs.headerTemplate.value =
//                            `<input
//                                class="scheduler-event-recorder-content form-control"
//                                disabled
//                                name="content"
//                                value="{content}"
//                            />`;
//                    eventRecorder.syncUI();
                    let auiEvents = events.map(function(event){
                        let tmp = {};
                        tmp.content = event.description;
                        tmp.startDate = new Date(event.start_date);
                        tmp.endDate = new Date(event.end_date);
                        tmp.color = event.color;
                        tmp.id = event.id;
                        return tmp;
                    });

//                    window.auiEvents = auiEvents;

                    scheduler = new Y.Scheduler(
                        {
                            activeView: monthView,
                            boundingBox: '#myScheduler',
                            date: new Date(),
                            items: auiEvents,
                            render: true,
                            eventRecorder: eventRecorder,
                            views: [dayView, weekView, monthView, agendaView]
                        }
                    );

//                    window.scheduler = scheduler;
                    let popoverBtnCancel;
                    let popoverBtnDetail;

                    Y.Do.after(function() {
                        let form = $('#schedulerEventRecorderForm');

                        let toolbarBtnGroup = Y.one(
                                            `#myScheduler
                                            form.scheduler-event-recorder-form
                                            div.popover-footer
                                            div.btn-group`
                                        );
                        window.toolbarBtnGroup = toolbarBtnGroup;
                        window.x = $(toolbarBtnGroup._node);
//                        x.removeClass('btn-group');
                        x.addClass('pull-right');
//                        console.log(x);
                        x.html(`
                            <button class="btn btn-default btn-sm" id="popoverBtnDetail">Detail</button>
                            <button class="btn btn-default btn-sm" id="popoverBtnCancel">Cancel</button>
                        `);

                        popoverBtnCancel = new Y.Button({
                            label: 'Cancel',
                            srcNode: '#popoverBtnCancel',
                        }).render();

                        popoverBtnCancel.on('click', function() {
                            eventRecorder.hidePopover();
                        });

                        popoverBtnDetail = new Y.Button({
                            label: 'Detail',
                            srcNode: '#popoverBtnDetail',
                        }).render();

                        popoverBtnDetail.on('click', function(e){
                            console.log(e);
                            e._event.stopPropagation();
                            let content = form.find('input[name="content"]').val();
                            let startDate = form.find('input[name="startDate"]').val();
                            let endDate = form.find('input[name="endDate"]').val();
                            let event = auiEvents.filter(function(val){
//                                return (val.content == content && val.startDate == startDate && val.endDate == endDate);
                                return (val.content == content)
                                        &&(val.startDate.getTime() == startDate)
                                        &&(val.endDate.getTime() == endDate)
                                        ;
                            });
                            console.log(event[0]);
                            let bookingId = event[0].id;
                            console.log(`booking id: ${bookingId}`);
                            window.location.href += `/${bookingId}`;
                        });
                    }, eventRecorder, 'showPopover');

                    Y.Do.after(function() {
                        // Make sure that the editButton is destroyed to avoid a memory leak.
                        if (popoverBtnCancel)
                            popoverBtnCancel.destroy();

                        if(popoverBtnDetail)
                            popoverBtnDetail.destroy();

                    }, eventRecorder, 'hidePopover');
                }
            );
//            setInterval(function(){
//                $('div.scheduler-event-title').css('color', '#fff');
//                $('div.scheduler-event-content').css('color', '#fff');
//            }, 1000);
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
                                   booking-start_date="{{ $booking->start_date }}"
                                   booking-end_date="{{ $booking->end_date }}"
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
                let booking_start_date = btn.attr('booking-start_date');
                let booking_end_date = btn.attr('booking-end_date');
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
                        //find out whole btn info ask JOIN, then remove
                        let btnParent = btn.parents('li');
                        btnParent.remove();

                        //add them BACK to scheduler
                        let event = {
                            content: booking_desscription,
                            startDate: new Date(booking_start_date),
                            endDate: new Date(booking_end_date)
                        };

//                        scheduler._events._items.push(event);
                        scheduler.addEvents(event);
                        scheduler.syncEventsUI();
//                        scheduler.syncUI();
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

