<!DOCTYPE html>
<html lang="{{ Lang::locale() }}" class="">

<head>
    <title>{{ env('APP_NAME') }} - @yield('pagetitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ Vite::asset('resources/images/inklusiva-call-favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ Vite::asset('resources/images/inklusiva-call-favicon-16.png') }}">
    @stack('scripts')
</head>

<body>
    @include('components.component-skipmenu', [
        'menuItems' => [
            'content' => 'Sprung zum Hauptinhalt',
            'footerMenu' => 'Sprung zum Footer',
            'helpMenu' => 'Sprung zur Hilfe',
        ],
    ])
    <div data-type="view" data-view-type="backend" data-view-id="backend">
        @include('components.component-burgermenue', [
            'onClick' => 'toggleOverlay(\'overlay-navigation\'); event.stopPropagation();',
        ])
        @include('layouts.backend.overlay-navigation')
        @include('layouts.includes.language')
        @include('layouts.backend.header')
        @stack('alert')
        <div data-type="area" data-area-type="main" data-area-id="main">
            <div data-type="area-wrapper">
                <div data-type="area" data-area-type="main-context" data-area-id="main-context">
                    <div data-type="area-wrapper">
                        <main aria-label="Hauptinhaltsbereich" id="content">
                            <div class="component context">
                                @yield('content')
                            </div>
                            @hasSection('formcontrols')
                                @include('components.component-formcontrols')
                            @endif
                        </main>
                    </div>
                    @stack('actions')
                </div>
                <div data-type="area" data-area-type="main-footer" data-area-id="main-footer">
                    <div data-type="area-wrapper">
                        @include('layouts.backend.footer')
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.addEventListener('click', checkCloseNavigation);

                document.querySelectorAll('#mainMenu li a').forEach(element => {
                    element.addEventListener('click', window.toggleNavigation);
                });

                document.querySelectorAll('#mainMenu-overlay li a').forEach(element => {
                    element.addEventListener('click', window.toggleNavigation);
                });

            });

        </script>
    </div>
    <div id="modalcontainer">
        @yield('modals')
    </div>
</body>

</html>
