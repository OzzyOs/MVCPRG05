<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact</title>



    <!-- Styles -->

</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<x-nav-link>
    <a href="home">Home</a>
</x-nav-link>
<!-- App layout -->
        @if (Route::has('login'))
            @auth
                <div>
                    <p>You are using a logged in view</p>
                </div>

                @else

                <div>
                    <p class="caret-amber-300">You are not logged in!</p>
                </div>
            @endauth
        @endif
</body>
</html>
