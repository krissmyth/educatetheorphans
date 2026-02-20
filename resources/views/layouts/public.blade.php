<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ $title ?? 'Educate the Orphans' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</head>
<body class="min-h-screen bg-white text-gray-900">

<header 
    x-data="{ open: false }" 
    class="sticky top-0 z-50 border-b bg-white"
>

    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold text-lg hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/logo.png') }}" alt="Educate the Orphans Logo" class="h-12 w-auto">
            <span>Educate the Orphans</span>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('projects') }}">Projects</a>
            <a href="{{ route('stories') }}">Stories</a>
            <a href="{{ route('news') }}">News</a>
            <a href="{{ route('contact') }}">Contact</a>

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
        <a href="{{ route('news') }}" class="block">News</a>
        <a href="{{ route('contact') }}" class="block">Contact</a>

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
            <p class="font-semibold">Educate the Orphans</p>
            <p class="text-sm text-gray-600 mt-2">
                Serving orphaned and needy children through education, care, and Christ-centered community support.
            </p>
        </div>

        <div>
            <p class="font-semibold">Quick Links</p>
            <ul class="mt-2 text-sm text-gray-600 space-y-1">
                <li><a class="hover:underline" href="{{ route('news') }}">News</a></li>
                <li><a class="hover:underline" href="{{ route('projects') }}">Projects</a></li>
                <li><a class="hover:underline" href="{{ route('stories') }}">Stories</a></li>
                <li><a class="hover:underline" href="{{ route('get-involved') }}">Get Involved</a></li>
                <li><a class="hover:underline" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div>
            <p class="font-semibold">Contact & Follow</p>
            <p class="text-sm text-gray-600 mt-2">
                Email: info@educatetheorphans.org<br>
                Location: Tharaka, Kenya
            </p>
            <div class="flex gap-4 mt-4">
                <a href="https://www.facebook.com/EducatetheOrphans" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 transition" title="Follow us on Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://www.instagram.com/etoministries/" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-pink-600 transition" title="Follow us on Instagram">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12s12-5.373 12-12c0-6.627-5.373-12-12-12zm0 2.16c2.686 0 3.006.01 4.061.059 2.537.115 3.855 1.465 3.97 3.97.048 1.056.058 1.376.058 4.061 0 2.686-.01 3.006-.059 4.061-.115 2.504-1.434 3.855-3.97 3.97-1.056.048-1.376.058-4.061.058-2.686 0-3.006-.01-4.061-.059-2.504-.115-3.856-1.465-3.971-3.97-.047-1.056-.058-1.376-.058-4.061 0-2.686.01-3.006.059-4.061.115-2.504 1.465-3.855 3.97-3.97 1.056-.047 1.376-.058 4.061-.058zm0 3.68c-2.263 0-4.16 1.897-4.16 4.16s1.897 4.16 4.16 4.16 4.16-1.897 4.16-4.16-1.897-4.16-4.16-4.16zm0 6.86c-1.488 0-2.7-1.212-2.7-2.7s1.212-2.7 2.7-2.7 2.7 1.212 2.7 2.7-1.212 2.7-2.7 2.7zm5.338-7.44c-.53 0-.96.43-.96.96s.43.96.96.96.96-.43.96-.96-.43-.96-.96-.96z"/></svg>
                </a>
                <a href="https://x.com/EtoMinistries" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-400 transition" title="Follow us on X">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
                <a href="https://www.youtube.com/channel/UCwqCS6I8bGI16yf1iM0h7dw?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-red-600 transition" title="Subscribe to our YouTube">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10 text-sm text-gray-500">
        © {{ now()->year }} Educate the Orphans. All rights reserved.
    </div>
</footer>

</body>
</html>