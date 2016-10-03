@extends('layouts.app')

@section('content')
    <input type="file" name="rooms_file">
    <pre id="wbJsonPre">
    </pre>
    <button id="btnLoad">load</button>
@endsection

@section('script_lib')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ url('js/rooms_load.js') }}">
        let rooms_file = document.querySelector('input[name="rooms_file"]');
        rooms_file.addEventListener('change', handleFile);
        function handleFile(e){
            let files = e.target.files;
            let f1 = files[0];
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(f1);
            fileReader.onload = function(e){
                let data = e.target.result;
                let wb = XLSX.read(data, {type: 'binary'});
                let wbJson = to_json(wb);
                function to_json(workbook){
                    let result = {};
                    workbook.SheetNames.forEach(function(sheetName){
                        var rowObjArr = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                        if(rowObjArr.length > 0){
                            result[sheetName] = rowObjArr;
                        }
                    });
                    return result;
                };
                console.log(wbJson);
            }
        };

    </script>
@endsection