@extends('layouts.app')

@section('content')
    <link href="http://kendo.cdn.telerik.com/2014.2.716/styles/kendo.common.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/kendo-ui-core/2014.1.416/styles/kendo.metro.min.css"/>
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/jquery.min.js"></script>
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/kendo.ui.core.min.js"></script>
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
                <span class="input-group-addon">Date</span>
                <input id="bookingDate" name="booking[date]">
                <script id="footer-template" type="text/x-kendo-template">
                    Today - #: kendo.toString(data, "d") #
                </script>
                <script>
                    $(document).ready(function(){
                        // create DateTimePicker from input HTML element
                        $("#bookingDate").kendoDateTimePicker({
                            format: "yyyy/MM/dd HH:mm:ss",
                            value: new Date(),
                            footer: kendo.template($("#footer-template").html())
                        });
                    });
                </script>
            </div>
            <small class="form-text text-muted">Pick up booking date</small>
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
            <input type="submit" name="submitBooking" value="Submit" class="btn btn-success pull-right">
        </div>

    </form>
@endsection