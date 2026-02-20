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
                <div class="text-sm text-gray-600">
                    {{ now()->format('l, F j, Y') }}
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
