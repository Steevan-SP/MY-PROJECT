<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #333;
        }
        .bg-primary {
            background-color: #1d4ed8; /* Blue background color */
        }
        .bg-secondary {
            background-color: #ffffff; /* White background color */
        }
        .text-primary {
            color: #1d4ed8; /* Blue text color */
        }
        .text-secondary {
            color: #555; /* Dark gray text color */
        }
        .hover\:text-primary:hover {
            color: #1d4ed8; /* Blue text color on hover */
        }
        .p-6 {
            padding: 1.5rem;
        }
        .p-8 {
            padding: 2rem;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .max-w-7xl {
            max-width: 80rem;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .h-16 {
            height: 4rem;
        }
        .w-auto {
            width: auto;
        }
        .flex {
            display: flex;
        }
        .justify-center {
            justify-content: center;
        }
        .items-center {
            align-items: center;
        }
        .min-h-screen {
            min-height: 100vh;
        }
        .relative {
            position: relative;
        }
        .fixed {
            position: fixed;
        }
        .top-0 {
            top: 0;
        }
        .right-0 {
            right: 0;
        }
        .z-10 {
            z-index: 10;
        }
        .heading {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            padding: 1rem;
            color: #1d4ed8;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-secondary">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-primary hover:text-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-primary">Log in</a>
                @endauth
            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8 text-center">
            <div class="flex justify-center">
                <svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto">
                    <!-- SVG content -->
                </svg>
            </div>
            <h1 class="heading">Web-Based Tourism Management System of Hunnasgirya Waterfall</h1>
        </div>
    </div>
</body>
</html>
