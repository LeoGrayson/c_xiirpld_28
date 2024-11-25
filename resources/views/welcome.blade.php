<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hospital Website</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
         <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="antialiased">
    <div class="overlay"></div>
    <div class="content">
        <h1>Welcome to our Hospital Website!</h1>
        <p>We will present you with our best service!</p>
        <div class="buttons mt-4">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
    <!-- <footer class="bg-gray-800 text-white text-center p-4">
        <p>&copy; {{ date('Y') }} Hospital Name. All rights reserved.</p>
    </footer> -->
</body>
</html>
