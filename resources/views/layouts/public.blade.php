<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>@yield('title', 'Educate the Orphans')</title>
    <meta name="description" content="@yield('meta_description', 'Educate the Orphans is a Christian charity feeding, clothing and educating orphaned and needy children in Tharaka, Kenya.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
    @stack('scripts')
</head>
<body class="min-h-screen bg-white text-gray-900">

<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-green-600 focus:px-4 focus:py-2 focus:text-white focus:font-semibold">
    Skip to main content
</a>

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
        <nav class="hidden md:flex items-center gap-6" aria-label="Main navigation">
            @php $navRoute = request()->route()->getName(); @endphp
            <a href="{{ route('about') }}" class="{{ $navRoute === 'about' ? 'font-semibold border-b-2 border-green-600' : 'hover:text-green-600' }} transition">About</a>
            <a href="{{ route('projects') }}" class="{{ $navRoute === 'projects' ? 'font-semibold border-b-2 border-green-600' : 'hover:text-green-600' }} transition">Projects</a>
            <a href="{{ route('stories') }}" class="{{ $navRoute === 'stories' ? 'font-semibold border-b-2 border-green-600' : 'hover:text-green-600' }} transition">Stories</a>
            <a href="{{ route('news') }}" class="{{ $navRoute === 'news' ? 'font-semibold border-b-2 border-green-600' : 'hover:text-green-600' }} transition">News</a>
            <a href="{{ route('contact') }}" class="{{ $navRoute === 'contact' ? 'font-semibold border-b-2 border-green-600' : 'hover:text-green-600' }} transition">Contact</a>

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
        aria-label="Mobile navigation"
    >
        <a href="{{ route('about') }}" class="block {{ $navRoute === 'about' ? 'font-semibold text-green-600' : '' }}">About</a>
        <a href="{{ route('projects') }}" class="block {{ $navRoute === 'projects' ? 'font-semibold text-green-600' : '' }}">Projects</a>
        <a href="{{ route('stories') }}" class="block {{ $navRoute === 'stories' ? 'font-semibold text-green-600' : '' }}">Stories</a>
        <a href="{{ route('news') }}" class="block {{ $navRoute === 'news' ? 'font-semibold text-green-600' : '' }}">News</a>
        <a href="{{ route('contact') }}" class="block {{ $navRoute === 'contact' ? 'font-semibold text-green-600' : '' }}">Contact</a>

        <a href="{{ route('donate') }}"
           class="block bg-green-600 text-white px-4 py-2 rounded-lg text-center font-semibold hover:bg-green-700">
           Donate
        </a>
    </div>
</header>


<main id="main-content">
    @yield('content')
</main>

<footer class="border-t mt-20">
    <div class="mx-auto max-w-6xl px-4 py-10 grid gap-8 md:grid-cols-3">
        <div class="text-center">
            <p class="font-semibold">Educate the Orphans</p>
            <p class="text-sm text-gray-600 mt-2">
                Serving orphaned and needy children<br>
                through education, care, and<br>
                Christ-centered community support.
            </p>
        </div>

        {{-- Cross --}}
        <div class="text-center flex flex-col items-center justify-center">
            <span class="text-5xl text-gray-400">✝</span>
            <p class="text-sm text-gray-500 italic mt-3">Serving and following the commands of Jesus</p>
        </div>

        <div class="text-center">
            <p class="font-semibold">Contact & Follow</p>
            <p class="text-sm text-gray-600 mt-2">
                Email: info@educatetheorphans.com
            </p>
            <div class="flex gap-4 mt-4 justify-center">
                <a href="https://www.facebook.com/EducatetheOrphans" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 transition" title="Follow us on Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
<a href="https://www.youtube.com/channel/UCwqCS6I8bGI16yf1iM0h7dw?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-red-600 transition" title="Subscribe to our YouTube">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10 text-sm text-gray-500 text-center">
        <p>© {{ now()->year }} Educate the Orphans. All rights reserved.</p>
        <p class="mt-2">Educate the Orphans is a fully registered charity, recognised by the Northern Ireland Charity Commission (Charity No. 102736).</p>
    </div>
</footer>

</body>
</html>