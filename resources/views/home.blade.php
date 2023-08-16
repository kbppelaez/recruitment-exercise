<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Home Page</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="{{ asset('app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="antialiased bg-gray-100 ">
        <div class="block mx-6 mt-4" style="padding-bottom: 4px; align-content: center;">
            <a href="{{ route('/account/logout') }}">
                <button class="mx-6" style="float:right; padding: 0.5em; background-color:#B7EBBD"> Logout </button>
            </a>
        </div>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
            <div class="bg-white p-6">
                <h3> Territories </h3>
                <span>Here are the list of territories</span>
                <ul id="territories">
                    
                </ul>
            </div>
        </div>
    </body>
</html>
