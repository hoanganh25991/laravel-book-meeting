@extends('layouts.app')

@section('content')
    <input type="file" name="rooms_file">
    <pre id="wbJsonPre">
    </pre>
@endsection

@section('script_lib')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/rooms_load.js"></script>
@endsection