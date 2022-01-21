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
    <div id="app" class="w-full flex flex-col">
          <!-- vue notification -->
          <notifications position="top right"></notifications>
          <!-- content -->
          @yield('content')
    </div>
</body>

</html>
