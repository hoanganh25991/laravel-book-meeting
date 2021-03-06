@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <h1 class="panel-heading">Booking Detail
                    @if($booking->created_by == Auth::id())
                        <a href='{{ url("booking/{$booking->id}/edit") }}' class="small fa fa-pencil pull-right"></a>
                    @endif
                </h1>
                @include('partials.booking-info')
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <h1 class="panel-heading">Invited Users</h1>
                <div class="panel-body">
                    @if($booking->created_by == Auth::id())
                        <div class="bg-info">
                            <p><a href='{{ url("booking/{$booking->id}/invite") }}'>Invite team members</a></p>
                        </div>
                    @endif
                    @foreach($users as $user)
                        <div class="form-group">
                            <div class="input-group usersList">
                                <span class="avatar-addon">
                                    <img src="{{ url('images/new-user-image-default.png') }}"
                                         alt="avatar"
                                         class="avatar img-thumbnail">
                                </span>
                                    <a href='{{ url("user/{$user->id}") }}' class="form-control">{{ $user->name }}</a>
                                    <a user-name="{{ $user->name }}"
                                       user-id="{{ $user->id }}"
                                       booking-id="{{ $booking->id }}"
                                       class="my-addon btn btn-info "
                                    >{{ $user->booking_status }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--danger zone > delete booking--}}
    @if($booking->created_by == Auth::id())
        <div class="panel panel-warning">
            <h1 class="panel-heading">Danger zone</h1>
            <div class="panel-body">
                <p>fjklasjdf aksdfjlas flaskfjla lkasjflaks f klasjdfl</p>
                <a class="btn btn-danger"
                   id="btnDelBooking"
                   booking-id="{{ $booking->id }}"
                   booking-description="{{ $booking->description }}"
                >Delete</a>
                <form action='{{ url("booking/$booking->id/delete") }}' method="POST" id="delBookingForm"></form>
            </div>
        </div>
    @endif
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        $(document).ready(function(){
            let btnDelBooking = $('#btnDelBooking');
            //                let booking_id = btnDelBooking.attr('booking-id');
            let booking_description = btnDelBooking.attr('booking-description');
            //                let flashDiv = $('.alert');
            let msg = `Do you want to delete <strong>${booking_description}</strong>`;
            //                let f_overlay = flashDiv.parent();
            //                console.log(f_overlay);
            let userActionDiv = $('<div class="modal fade"></div>');
            userActionDiv.html(`
                    <div class="modal-dialog">
                         <div class="panel panel-danger">
                            <h2 class="panel-heading">Do you want to ${msg}</h2>
                            <div class="panel-body" id="userAction">
                                <div class="pull-right">
                                    <a class="btn btn-danger" data-dismiss="modal">YES</a>
                                    <a class="btn btn-default" data-dismiss="modal">CANCEL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

            let userActionBinded = false;

            userActionDiv.on('shown.bs.modal', function(){
                //                        console.log($('#userAction').find('a'));
                if(userActionBinded){
                    return;
                }
                userActionBinded = true;
                $('#userAction').find('a').each(function(index, val){
                    //                        console.log(val);
                    let btn = $(val);
                    btn.on('click', function(){
                        let userAction = btn.text();
                        console.log(userAction);

                        if(userAction == 'YES'){
                            $('#delBookingForm').submit();
                        }
                    });
                });
            });

            btnDelBooking.on('click', function(){
                userActionDiv.modal();
            });
        });
    </script>
@endsection