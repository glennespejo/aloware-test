@extends('layouts.dashmix')
@section('content')
@section('styles')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('themes/dashmix/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection
<div id="app">
    <customer></customer>
</div>
<!-- END Search -->
@endsection
@section('scripts')
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{asset('themes/dashmix/assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
    <script src="{{mix('compiled/js/customer/customer.js')}}"></script>
@endsection
