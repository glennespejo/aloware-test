@extends('layouts.dashmix')
@section('content')
@section('styles')
<div id="app">
    <div class="content content-full">
        <div class="row justify-content-center">
            <div class="col-sm-8 py-5">
                <post></post>
            </div>
        </div>
    </div>
</div>
<!-- END Search -->
@endsection
@section('scripts')
    <script src="{{mix('js/home.js')}}"></script>
@endsection
