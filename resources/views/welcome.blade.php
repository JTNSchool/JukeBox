<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jukebox</title>
        @vite('resources/css/app.css')

    </head>
    <body class="font-sans antialiased dark:bg-gray-800 dark:text-gray-300">
        @if (Route::has('login'))
            <div class="flex justify-center items-center h-screen">
                @auth
                    @php
                        header('Location: ' . url('/home'));
                        exit()
                    @endphp
                @else
                    <a href="{{ route('login') }}" class="px-20 py-8 bg-blue-600 text-white rounded-md mx-2 hover:bg-blue-700 transition">Log in</a>
                    <a href="{{ route('register') }}" class="px-20 py-8 bg-blue-600 text-white rounded-md mx-2 hover:bg-blue-700 transition">Register</a>
                @endauth
            </div>
        @endif
    </body>
</html>
