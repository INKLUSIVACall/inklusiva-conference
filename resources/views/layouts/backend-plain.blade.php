<!DOCTYPE html>
<html lang="de">

<head>
    <title>{{ env('APP_NAME') }} - @yield('pagetitle')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ Vite::asset('resources/images/inklusiva-call-favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ Vite::asset('resources/images/inklusiva-call-favicon-16.png') }}">
</head>

<body>
    @include('layouts.includes.language')
    @yield('content')
    <div id="modalcontainer"></div>
</body>

</html>
