<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="{{ asset('app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="antialiased">
        <div class="relative bg-gray-100 sm:flex sm:justify-center sm:items-center min-h-screen">

            <div class="bg-white p-6">
                <form action="{{ route('/account/login') }}" method="POST">
                    @csrf

                    <div class="mx-6">
                        <label for="username">Username</label>
                        <br>
                        <input style="padding: 1px 5px; border: 1px solid #4CAF50" type="text" id="username" name="username" value="{{ old('username') }}" required autofocus placeholder="Username" />
                    </div>

                    <div class="mx-6 mt-4">
                        <label for="password">Password</label>
                        <br>
                        <input style="padding: 1px 5px; border: 1px solid #4CAF50"  type="password" id="password" name="password" value="{{ old('password') }}" required placeholder="Password" />

                        @if($errors->has('invalid'))
                            <br>
                            <span style="color: red;">
                                <strong>{{ $errors->first('invalid') }}</strong>
                            </span>
                        @endif    
                    </div>
                    
                    <div style="align-items: end;" >
                        <button class="mx-6 mt-4" style="float:right; padding: 0.5em; background-color:#B7EBBD" type="submit"> Login </button>
                    </div>
                    
                </form>

            </div>
        </div>
    </body>
</html>
