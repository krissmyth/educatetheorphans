<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ $title ?? 'Admin' }} - Educate the Orphans</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 border-b border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                <span class="text-sm">ETO Admin</span>
            </a>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-600' : 'hover:bg-gray-800' }} transition-colors">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.donations.index') }}" 
               class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.donations.*') ? 'bg-green-600' : 'hover:bg-gray-800' }} transition-colors">
                💰 Donations
            </a>
            <a href="{{ route('profile.edit') }}" 
               class="block px-4 py-3 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-green-600' : 'hover:bg-gray-800' }} transition-colors">
                ⚙️ Profile Settings
            </a>
            <a href="{{ route('home') }}" 
               class="block px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                🏠 Back to Website
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <span>🚪</span>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1">
        {{-- Header --}}
        <header class="bg-white border-b px-8 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center gap-6">
                    <div class="text-sm text-gray-600">
                        {{ now()->format('l, F j, Y') }}
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ auth()->user()->name ?? 'Guest' }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <div class="p-8">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
