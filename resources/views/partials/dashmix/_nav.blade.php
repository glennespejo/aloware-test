<div class="bg-header-dark">
    <div class="content-header bg-white-10">
        <a class="font-w600 text-white tracking-wide" href="/">
            <span class="smini-visible">
                A<span class="opacity-75">L</span>
            </span>
            <span class="smini-hidden">
                Alo<span class="opacity-75 text-success">ware</span>
            </span>
        </a>
        <div>
            <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');" href="javascript:void(0)">
                <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
            <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-times-circle"></i>
            </a>
        </div>
    </div>
</div>
<div class="js-sidebar-scroll">
    <div class="content-side">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link  {{Request::is('/') ? 'active' : '' }}" href="/">
                    <i class="nav-main-link-icon fa fa-location-arrow"></i>
                    <span class="nav-main-link-name">Home</span>
                </a>
            </li>
        </ul>
    </div>
</div>
