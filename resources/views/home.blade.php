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
    <body class="antialiased">
        <div class="relative bg-gray-100 sm:flex sm:justify-center sm:items-center min-h-screen">
            <div class="mx-6 mt-4" style="align-content: stretch;">
                <a href="{{ route('/account/logout') }}" class="ml-4 font-semibold bg-white text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style=" padding: 0.5em">
                    Logout
                </a>
            </div>
            <br>
            <div class="mx-6 mt-4">
                home page here
            </div>
        </div>
    </body>
</html>
