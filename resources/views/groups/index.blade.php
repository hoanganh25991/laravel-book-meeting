@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <h1 class="panel-heading">Groups</h1>
        <div class="panel-body">
            <div class="bg-warning">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <ul class="small">
                    <li>Find your group</li>
                    <li><a href="{{ url('group/create') }}">Create new one</a></li>
                </ul>
            </div>

            <div id="groupList">
                @foreach($groups as $group)
                    <div>
                        <div class="zero-clipboard">
                        <span group-id="{{ $group->id }}"
                              group-name="{{ $group->name }}"
                              class="btn-clipboard btn-info"
                        >{{ $group->user_status }}</span>
                        </div>
                        <figure class="highlight">
                            <h4>{{ $group->name }}</h4>
                            <p>{{ $group }}</p>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#groupList').on('click', 'span.btn-clipboard', function(){
                let btn = $(this);
                let status = btn.text();
                console.log(status);
                if(status == 'pending'){
                    flash('Please wait for group-host accept it');
                    return;
                }
                let group_id = btn.attr('group-id');
                let group_name = btn.attr('group-name');
                console.log(group_id);
                $.post({
                    url: "{{ url('group/join') }}",
                    data: {
                        group_id: group_id
                    },
                    success: function(res){
                        console.log(res);
                        btn.text('pending');
                        flash(`Have ask <strong>${group_name}</strong>-host, please wait for accept`);
                    },
                    error: function(res){
                        console.log(res);
                    }
                });
            });
        });
    </script>
@endsection