<!doctype html>
<html lang="en">
    <head>
        @include('partials.dashmix._head')
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <aside id="side-overlay">
            </aside>
            <nav id="sidebar" aria-label="Main Navigation">
                @include('partials.dashmix._nav')
            </nav>
            <header id="page-header">
                @include('partials.dashmix._header')
            </header>
            <main id="main-container">
                <div class="content content-full">
                    @yield('content')
                </div>
            </main>
            <footer id="page-footer" class="bg-white">
                @include('partials.dashmix._footer')
            </footer>
        </div>
        @include('partials.dashmix._global_scripts')
    </body>
</html>
