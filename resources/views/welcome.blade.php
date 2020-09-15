<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Feedle') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif

            <div class="container">
                <div class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl text-indigo-600 font-bold mb-6 lg:mb-8">
                    Atom and RSS
                </div>
                <div class="text-lg lg:text-xl xl:text-2xl text-gray-800 mb-6 lg:mb-12">
                    Follow all your feeds, from anywhere.
                </div>
                <a href="{{ route('register') }}" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-indigo-600 leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150">
                    Get Started
                </a>
            </div>
        </div>
    </body>
</html>
