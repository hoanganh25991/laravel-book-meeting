@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <h1 class="panel-heading">Load rooms from excel-file</h1>
        <div class="panel-body">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Excel-file</span>
                    <input type="file" name="rooms_file" class="form-control">
                </div>
            </div>
            <p id="wbJsonPre"></p>
            <form action="" method="POST" id="loadRoom">
                <input type="hidden" name="rooms">
                <div class="checkbox">
                    <label><input type="checkbox" name="reload" value="true">Do you want to reload all room?</label>
                </div>
                <button id="btnLoad" class="btn btn-info">Load</button>
            </form>
        </div>
    </div>
@endsection

@section('script_lib')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.min.js"></script>
    <script src="{{ url('js/flash.js') }}"></script>
    <script>
        /**
         * Created by hoanganh25991 on 29/09/16.
         */
        let rooms_file = $('input[name="rooms_file"]');

        let roomsInput = $('input[name="rooms"]');

        let form = $('form#loadRoom');

        rooms_file.on('change', handleFile);
        function handleFile(e){
            let files = e.target.files;
            let f1 = files[0];
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(f1);
            fileReader.onload = function(e){
                let data = e.target.result;
                //noinspection JSUnresolvedVariable
                let wb = XLSX.read(data, {type: 'binary'});

                let wbJson = XLSX.utils.sheet_to_row_object_array(wb.Sheets['Sheet1']);
                wbJson.forEach(function(val){
                    var created_at = new Date().toISOString().slice(0, 19).replace('T', ' ');
                    val.created_at = created_at;
                    val.updated_at = created_at;
                })
                ;
                // console.log(wbJson);
                let wbJsonPre = $('#wbJsonPre');
                let wbJsonStr = JSON.stringify(wbJson);
                wbJsonPre.html(`<pre>${wbJsonStr}</pre>`);
                roomsInput.val(wbJsonStr);
            }
        };
        let btnLoad = $('#btnLoad');
        btnLoad.on('click', function(e){
            e.preventDefault();
            let roomsJson = roomsInput.val();
//            console.log(roomsJson);

            if(!roomsJson.trim()){
                flash(`Please upload <strong>excel-file</strong> first`, 'warning');
                return;
            }
//            console.log(roomsJson);
            form.submit();
        });
    </script>
@endsection