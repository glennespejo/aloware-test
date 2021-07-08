<!doctype html>
<html lang="en">
    <head>
        @include('partials.dashmix._head')
    </head>
    <body>
        <div id="page-container" class="page-header-dark main-content-boxed">
            <main id="main-container">
                @yield('content')
            </main>
        </div>
        @include('partials.dashmix._global_scripts')
    </body>
</html>
