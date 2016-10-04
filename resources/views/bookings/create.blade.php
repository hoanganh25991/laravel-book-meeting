@extends('layouts.app')

@section('content')
    {{--<div class="bs-docs-section">--}}
    <link href="http://kendo.cdn.telerik.com/2014.2.716/styles/kendo.common.min.css" rel="stylesheet"/>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/kendo-ui-core/2014.1.416/styles/kendo.metro.min.css"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/kendo-ui-core/2014.1.416/styles/kendo.bootstrap.min.css" />
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/jquery.min.js"></script>
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/kendo.ui.core.min.js"></script>

    <h1>New Booking</h1>
    <form action="{{ url('booking/create') }}" method="POST" id="bookingCreateForm">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Title</span>
                <input type="text" name="booking[description]" class="form-control">
            </div>
            <small class="form-text text-muted">Title of the booking</small>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Start</span>
                <input id="bookingStartDate" name="booking[start_date]">
                <script id="footer-template" type="text/x-kendo-template">
                    Today - #: kendo.toString(data, "d") #
                </script>
            </div>
            <small class="form-text text-muted">Pick up booking start date</small>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">End</span>
                <input id="bookingEndDate" name="booking[end_date]">
            </div>
            <small class="form-text text-muted">Pick up booking end date</small>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Room</span>
                <select name="booking[room_id]" class="form-control">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Choose the room</small>
        </div>

        <div class="form-group">
            <input type="submit" name="submitBooking" value="Create" class="btn btn-info pull-right">
        </div>
    </form>
    <script>
        $(document).ready(function(){
            // create DateTimePicker from input HTML element
            let startDatePicker = $("#bookingStartDate");
            let endDatePicker = $("#bookingEndDate");

            let haveSuggested = false;

            startDatePicker.kendoDateTimePicker({
                format: "yyyy/MM/dd HH:mm",
                value: new Date(),
                footer: kendo.template($("#footer-template").html())
            });

            startDatePicker.on('change', function(){
                !haveSuggested ? (function(){
                    //get data from startDatePicker
                    let startData = startDatePicker.data('kendoDateTimePicker');
                    //extract what userA choose
                    let startDate = new Date(startData.value());
                    //suggest end date (1h later)
                    let endDate = startDate.getTime() + 60 * 60 * 1000;
                    //update ui
                    endDatePicker.kendoDateTimePicker({
                        format: "yyyy/MM/dd HH:mm",
                        value: new Date(endDate)
                    });
                    haveSuggested = true;
                })() : false;
            });
        });
    </script>
@endsection