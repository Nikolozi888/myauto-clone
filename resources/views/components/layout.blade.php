<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyAuto-Clone')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="{{ asset('public.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public.css') }}">

</head>

<body class="bg-gray-100">

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded text-center">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')


</body>

</html>
