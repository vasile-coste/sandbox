<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sandbox Admin</title>

    <!-- Css Styling -->
    <!-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- <script defer src="{{ mix('js/app.js') }}"></script> -->
    <script defer src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-white">
    <div id="app" class="min-h-full w-full flex flex-col">
        <!-- vue notification -->
        <notifications position="top right"></notifications>

        <!-- navigation -->
        @if(Auth::check())
          <nav-menu current="{{Request::path()}}"></nav-menu>
        @endif

        <!-- content -->
        <div class="w-full pt-2">
          @yield('content')
        </div>
    </div>
</body>

</html>
