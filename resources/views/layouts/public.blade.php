<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ETO Ministries' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-900">

<header class="border-b bg-white/80 backdrop-blur sticky top-0 z-50">
    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-semibold text-lg tracking-tight">
            ETO Ministries
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('about') }}" class="hover:underline">About</a>
            <a href="{{ route('projects') }}" class="hover:underline">Projects</a>
            <a href="{{ route('stories') }}" class="hover:underline">Stories</a>
            <a href="{{ route('get-involved') }}" class="hover:underline">Get Involved</a>
            <a href="{{ route('donate') }}"
   class="ml-2 bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 shadow-sm">
   Donate
</a>

            </a>
        </nav>

        <div class="flex items-center gap-3 text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
            @endauth
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="border-t mt-20">
    <div class="mx-auto max-w-6xl px-4 py-10 grid gap-8 md:grid-cols-3">
        <div>
            <p class="font-semibold">ETO Ministries</p>
            <p class="text-sm text-gray-600 mt-2">
                Serving orphaned and needy children through education, care, and Christ-centered community support.
            </p>
        </div>

        <div>
            <p class="font-semibold">Quick Links</p>
            <ul class="mt-2 text-sm text-gray-600 space-y-1">
                <li><a class="hover:underline" href="{{ route('projects') }}">Projects</a></li>
                <li><a class="hover:underline" href="{{ route('stories') }}">Stories</a></li>
                <li><a class="hover:underline" href="{{ route('get-involved') }}">Get Involved</a></li>
                <li><a class="hover:underline" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div>
            <p class="font-semibold">Contact</p>
            <p class="text-sm text-gray-600 mt-2">
                Email: info@eto-ministries.org<br>
                Location: Tharaka, Kenya
            </p>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10 text-sm text-gray-500">
        © {{ date('Y') }} ETO Ministries. All rights reserved.
    </div>
</footer>

</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ETO Ministries' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-900">

<header class="border-b bg-white/80 backdrop-blur sticky top-0 z-50">
    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-semibold text-lg tracking-tight">
            ETO Ministries
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('about') }}" class="hover:underline">About</a>
            <a href="{{ route('projects') }}" class="hover:underline">Projects</a>
            <a href="{{ route('stories') }}" class="hover:underline">Stories</a>
            <a href="{{ route('get-involved') }}" class="hover:underline">Get Involved</a>
            <a href="{{ route('donate') }}" class="inline-flex items-center rounded-lg bg-black px-4 py-2 text-white font-semibold hover:bg-gray-800">
                Donate
            </a>
        </nav>

        <div class="flex items-center gap-3 text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
            @endauth
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="border-t mt-20">
    <div class="mx-auto max-w-6xl px-4 py-10 grid gap-8 md:grid-cols-3">
        <div>
            <p class="font-semibold">ETO Ministries</p>
            <p class="text-sm text-gray-600 mt-2">
                Serving orphaned and needy children through education, care, and Christ-centered community support.
            </p>
        </div>

        <div>
            <p class="font-semibold">Quick Links</p>
            <ul class="mt-2 text-sm text-gray-600 space-y-1">
                <li><a class="hover:underline" href="{{ route('projects') }}">Projects</a></li>
                <li><a class="hover:underline" href="{{ route('stories') }}">Stories</a></li>
                <li><a class="hover:underline" href="{{ route('get-involved') }}">Get Involved</a></li>
                <li><a class="hover:underline" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div>
            <p class="font-semibold">Contact</p>
            <p class="text-sm text-gray-600 mt-2">
                Email: info@eto-ministries.org<br>
                Location: Tharaka, Kenya
            </p>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10 text-sm text-gray-500">
        © {{ date('Y') }} ETO Ministries. All rights reserved.
    </div>
</footer>

</body>
</html>
