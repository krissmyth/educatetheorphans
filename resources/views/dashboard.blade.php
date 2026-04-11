@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 px-5 py-4 text-green-800 font-medium">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="rounded-lg bg-yellow-50 border border-yellow-200 px-5 py-4 text-yellow-800 font-medium">
                ⚠ {{ session('warning') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-lg bg-red-50 border border-red-200 px-5 py-4 text-red-800 font-medium">
                ✗ {{ session('error') }}
            </div>
        @endif

        {{-- Welcome Banner --}}
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg shadow-sm p-6 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</h2>
                <p class="mt-1 text-green-100">Here's an overview of your website activity and quick access to key tools.</p>
            </div>
            <form method="POST" action="{{ route('admin.news.sync') }}">
                @csrf
                <button type="submit"
                    class="shrink-0 bg-white text-green-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-green-50 transition text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Sync News from Mailchimp
                </button>
            </form>
        </div>

        {{-- Analytics Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Today's Page Views</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayPageViews }}</p>
                    </div>
                    <div class="text-4xl">📄</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Today's Visitors</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayUniqueVisitors }}</p>
                    </div>
                    <div class="text-4xl">👥</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">30-Day Page Views</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalPageViews }}</p>
                    </div>
                    <div class="text-4xl">📈</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">30-Day Visitors</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalVisitors }}</p>
                    </div>
                    <div class="text-4xl">🌍</div>
                </div>
            </div>
        </div>

        {{-- Most Viewed Pages + Traffic Sources --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Most Viewed Pages</h3>
                @if(count($mostViewedPages) > 0)
                    <div class="space-y-3">
                        @foreach($mostViewedPages as $page)
                            <div class="flex items-center justify-between pb-3 border-b last:border-0">
                                <p class="text-gray-800 font-medium text-sm">{{ $page->page_name ?? 'Unknown' }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $page->views }} views
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-sm">No page view data available yet.</p>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Top Traffic Sources</h3>
                @if(count($topReferrers) > 0)
                    <div class="space-y-3">
                        @foreach($topReferrers as $referrer)
                            <div class="flex items-center justify-between pb-3 border-b last:border-0">
                                <p class="text-gray-800 font-medium text-sm truncate flex-1 mr-4">
                                    {{ parse_url($referrer->referer, PHP_URL_HOST) ?? $referrer->referer }}
                                </p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $referrer->visits }} visits
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-sm">No referrer data available yet.</p>
                @endif
            </div>
        </div>

        {{-- 7-Day Activity --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">7-Day Activity</h3>
            @if(count($visitorsTrend) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-3 font-semibold text-gray-600">Date</th>
                                <th class="text-center py-2 px-3 font-semibold text-gray-600">Visitors</th>
                                <th class="text-center py-2 px-3 font-semibold text-gray-600">Page Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($visitorsTrend as $trend)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-3 text-gray-700">{{ date('D, M d', strtotime($trend->date)) }}</td>
                                    <td class="py-3 px-3 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $trend->visitors ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $trend->page_views ?? 0 }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-gray-400">No activity data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400 text-sm">No activity data available yet.</p>
            @endif
        </div>

        {{-- Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Website Pages --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Website Pages</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([
                        ['route' => 'home',         'label' => 'Home'],
                        ['route' => 'about',        'label' => 'About'],
                        ['route' => 'projects',     'label' => 'Projects'],
                        ['route' => 'stories',      'label' => 'Stories'],
                        ['route' => 'news',         'label' => 'News'],
                        ['route' => 'donate',       'label' => 'Donate'],
                        ['route' => 'contact',      'label' => 'Contact'],
                        ['route' => 'get-involved', 'label' => 'Get Involved'],
                    ] as $link)
                        <a href="{{ route($link['route']) }}"
                           target="_blank"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg border text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-green-400 transition">
                            <span class="text-green-600">↗</span> {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- External Services --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">External Services</h3>
                <div class="space-y-3">
                    <a href="https://www.justgiving.com/educatetheorphans"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 hover:border-green-400 transition">
                        <div>
                            <p class="font-semibold text-sm text-gray-900">JustGiving</p>
                            <p class="text-xs text-gray-500">View your charity donation page</p>
                        </div>
                        <span class="text-green-600 font-semibold text-sm">Open →</span>
                    </a>

                    <a href="https://login.mailchimp.com"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 hover:border-green-400 transition">
                        <div>
                            <p class="font-semibold text-sm text-gray-900">Mailchimp</p>
                            <p class="text-xs text-gray-500">Manage your newsletter & subscribers</p>
                        </div>
                        <span class="text-green-600 font-semibold text-sm">Open →</span>
                    </a>

                    <a href="https://www.facebook.com/EducatetheOrphans"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 hover:border-green-400 transition">
                        <div>
                            <p class="font-semibold text-sm text-gray-900">Facebook</p>
                            <p class="text-xs text-gray-500">Educate the Orphans page</p>
                        </div>
                        <span class="text-green-600 font-semibold text-sm">Open →</span>
                    </a>

                    <a href="https://www.instagram.com/etoministries/"
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 hover:border-green-400 transition">
                        <div>
                            <p class="font-semibold text-sm text-gray-900">Instagram</p>
                            <p class="text-xs text-gray-500">@etoministries</p>
                        </div>
                        <span class="text-green-600 font-semibold text-sm">Open →</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
