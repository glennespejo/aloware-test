<script src="{{ asset('themes/dashmix/assets/js/dashmix.core.min.js') }}"></script>
<script src="{{ asset('themes/dashmix/assets/js/dashmix.app.min.js') }}"></script>
<script src="{{ asset('themes/dashmix/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
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
@if(Session::has('warning'))
<script>
    jQuery(function(){
        Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-times mr-1', message: '{{ Session::get('warning') }}'});
    });
</script>
@endif
@if($errors->any())
@foreach($errors->all() as $error)
<script>
    jQuery(function(){
        Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: '{{ $error }}'});
    });
</script>
@endforeach
@endif

<script>
    function dashmixAjxNotify(type, message)
    {
        switch (type)
        {
            case 'success':
                Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: message});
            break;
            case 'info':
                Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-info-circle mr-1', message: message});
            break;
            case 'error':
                Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: message});
            break;
            case 'warning':
                Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-exclamation mr-1', message: message});
            break;
        }
    }
</script>

@yield('scripts')
