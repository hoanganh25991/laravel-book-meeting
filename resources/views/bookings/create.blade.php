@extends('layouts.app')

@section('content')
    <link href="http://kendo.cdn.telerik.com/2014.2.716/styles/kendo.common.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/kendo-ui-core/2014.1.416/styles/kendo.metro.min.css"/>
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/jquery.min.js"></script>
    <script src="http://kendo.cdn.telerik.com/2014.2.716/js/kendo.ui.core.min.js"></script>
    <form action="/booking/create" method="POST">
        <label for="bookingDate">Date:</label>
        <!-- <input type="date" name="date" id="bookingDate"> -->
        <input id="bookingDate" style="width: 100%;" name="date"/>
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
        {{--<input type="number" name="room" id="bookingRoom">--}}
        <select name="room" id="bookingRoom">
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
        </select>
        <input type="submit" name="submitBooking" value="submit">
    </form>
@endsection