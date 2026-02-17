<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ETO Ministries' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-900">

<header 
    x-data="{ open: false }" 
    class="sticky top-0 z-50 border-b bg-white"
>

    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-semibold text-lg">
            ETO Ministries
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('projects') }}">Projects</a>
            <a href="{{ route('stories') }}">Stories</a>

            <a href="{{ route('donate') }}"
               class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
               Donate
            </a>
        </nav>

        <!-- Mobile Button -->
<button 
    @click="open = !open"
    class="md:hidden text-2xl"
>
    ☰
</button>


    </div>

    <!-- Mobile Menu -->
    <div 
        x-cloak
		x-show="open"
		@click.outside="open = false"
        x-transition
        class="md:hidden px-4 pb-4 space-y-3"
    >
        <a href="{{ route('about') }}" class="block">About</a>
        <a href="{{ route('projects') }}" class="block">Projects</a>
        <a href="{{ route('stories') }}" class="block">Stories</a>

        <a href="{{ route('donate') }}"
           class="block bg-green-600 text-white px-4 py-2 rounded-lg text-center font-semibold">
           Donate
        </a>
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
        © {{ now()->year }} ETO Ministries. All rights reserved.
    </div>
</footer>

</body>
</html>