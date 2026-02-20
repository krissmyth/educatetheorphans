@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Key Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            {{-- Today's Page Views --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Today's Page Views</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayPageViews }}</p>
                        </div>
                        <div class="text-4xl text-blue-500">📊</div>
                    </div>
                </div>
            </div>

            {{-- Today's Unique Visitors --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Today's Visitors</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayUniqueVisitors }}</p>
                        </div>
                        <div class="text-4xl text-green-500">👥</div>
                    </div>
                </div>
            </div>

            {{-- 30 Day Page Views --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">30 Day Views</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPageViews }}</p>
                        </div>
                        <div class="text-4xl text-purple-500">📈</div>
                    </div>
                </div>
            </div>

            {{-- Total Donations --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Donations (30 days)</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">£{{ $totalDonations }}</p>
                        </div>
                        <div class="text-4xl text-yellow-500">💰</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Donation Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-600 text-sm font-medium">Total Donors (30 days)</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $donationCount }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-600 text-sm font-medium">Average Donation</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">£{{ $averageDonation }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-600 text-sm font-medium">30 Day Unique Visitors</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalVisitors }}</p>
                </div>
            </div>
        </div>

        {{-- Most Viewed Pages --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📄 Most Viewed Pages</h3>
                    @if(count($mostViewedPages) > 0)
                        <div class="space-y-3">
                            @foreach($mostViewedPages as $page)
                                <div class="flex items-center justify-between pb-3 border-b">
                                    <div class="flex-1">
                                        <p class="text-gray-900 font-medium">{{ $page->page_name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ substr($page->page_url, 0, 40) }}...</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $page->views }} views
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No page view data available yet.</p>
                    @endif
                </div>
            </div>

            {{-- Top Traffic Sources --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">🔗 Top Traffic Sources</h3>
                    @if(count($topReferrers) > 0)
                        <div class="space-y-3">
                            @foreach($topReferrers as $referrer)
                                <div class="flex items-center justify-between pb-3 border-b">
                                    <div class="flex-1">
                                        <p class="text-gray-900 font-medium text-sm truncate">
                                            @php
                                                $host = parse_url($referrer->referer, PHP_URL_HOST) ?? $referrer->referer;
                                                echo strlen($host) > 35 ? substr($host, 0, 35) . '...' : $host;
                                            @endphp
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $referrer->visits }} visits
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No referrer data available yet.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Access Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            {{-- Donations Management Card --}}
            <a href="{{ route('admin.donations.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl mr-4">💳</div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">Donations</h3>
                            <p class="text-sm text-gray-600">Manage & track donations</p>
                        </div>
                    </div>
                    <div class="text-blue-600 font-semibold text-sm">View All →</div>
                </div>
            </a>

            {{-- Profile Settings Card --}}
            <a href="{{ route('profile.edit') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl mr-4">⚙️</div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">Settings</h3>
                            <p class="text-sm text-gray-600">Update profile & password</p>
                        </div>
                    </div>
                    <div class="text-blue-600 font-semibold text-sm">Manage →</div>
                </div>
            </a>

            {{-- Website Card --}}
            <a href="{{ route('home') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-4xl mr-4">🌐</div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">Website</h3>
                            <p class="text-sm text-gray-600">View public site</p>
                        </div>
                    </div>
                    <div class="text-blue-600 font-semibold text-sm">Visit →</div>
                </div>
            </a>
        </div>

        {{-- 7-Day Activity Overview --}}
        @if(count($visitorsTrend) > 0 || count($pageViewsTrend) > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📊 7-Day Activity Overview</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2 px-2 font-semibold text-gray-700">Date</th>
                                    <th class="text-center py-2 px-2 font-semibold text-gray-700">Visitors</th>
                                    <th class="text-center py-2 px-2 font-semibold text-gray-700">Page Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitorsTrend as $trend)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-2 text-gray-800">
                                            {{ date('D, M d', strtotime($trend->date)) }}
                                        </td>
                                        <td class="py-3 px-2 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $trend->visitors ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                0
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-4 px-2 text-center text-gray-500">
                                            No activity data available yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
