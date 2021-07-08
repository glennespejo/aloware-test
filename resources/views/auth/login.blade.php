@extends('layouts.auth')
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('themes/dashmix/assets/media/photos/photo13@2x.jpg') }}');">
    <div class="row no-gutters justify-content-center bg-black-75">
        <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
            <!-- Sign Up Block -->
            <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                    <!-- Header -->
                    <div class="mb-2 text-center">
                        <a class="link-fx font-w700 font-size-h1" href="/">
                            <span>Alo</span><span class="text-success">ware</span>
                        </a>
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Login</p>
                    </div>
                    <form class="js-validation-signin" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input autocomplete="off" type="text" class="form-control" id="login-username" name="email" placeholder="Email">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope-open"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-asterisk"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-hero-primary">
                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                            </button>
                        </div>
                    </form>
                    <!-- END Sign Up Form -->
                </div>
            </div>
        </div>
        <!-- END Sign Up Block -->
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('themes/dashmix/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
@if(Session::has('success'))
<script>
    jQuery(function(){
        Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{ Session::get('success') }}'});
    });
</script>
@endif
@if(Session::has('error'))
<script>
    jQuery(function(){
        Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: '{{ Session::get('error') }}'});
    });
</script>
@endif
@endsection
