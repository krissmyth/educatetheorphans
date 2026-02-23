@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/News.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="News and Updates"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">News & Updates</h1>
                <p class="mt-5 text-lg text-gray-200">Stay informed about our latest initiatives, stories, and impact updates from the field.</p>
            </div>
        </div>
    </div>
</section>

{{-- NEWS LISTING --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        @if (!empty($campaigns))
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($campaigns as $campaign)
                    <a href="{{ route('news.show', $campaign['id']) }}" class="group block border rounded-lg overflow-hidden hover:shadow-lg transition">
                        <!-- Featured Image -->
                        <div class="relative h-48 overflow-hidden bg-gray-200">
                            @if ($campaign['featured_image'])
                                <img
                                    src="{{ $campaign['featured_image'] }}"
                                    alt="{{ $campaign['subject'] }}"
                                    class="h-full w-full object-cover object-top group-hover:scale-105 transition duration-300"
                                    loading="lazy"
                                >
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition line-clamp-2 mb-2">
                                {{ $campaign['subject'] }}
                            </h3>

                            <!-- Preview -->
                            @if (!empty($campaign['preview']))
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $campaign['preview'] }}</p>
                            @endif

                            <!-- Meta Info -->
                            <div class="space-y-2 mb-4 text-sm text-gray-600">
                                @if ($campaign['send_time'])
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold">Sent:</span>
                                        <time datetime="{{ $campaign['send_time'] }}">
                                            {{ \Carbon\Carbon::parse($campaign['send_time'])->format('M j, Y') }}
                                        </time>
                                    </div>
                                @endif
                            </div>

                            <!-- Status Badge -->
                            <div class="flex items-center gap-2 mb-4">
                                @if ($campaign['status'] === 'sent')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                        Sent
                                    </span>
                                @elseif ($campaign['status'] === 'schedule')
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                        Scheduled
                                    </span>
                                @elseif ($campaign['status'] === 'paused')
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                                        Paused
                                    </span>
                                @endif
                            </div>

                            <!-- Read More Link -->
                            <div class="text-green-600 font-semibold group-hover:text-green-700 transition">
                                Read More →
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">No campaigns yet</h3>
                <p class="mt-2 text-gray-600">We'll be sharing updates soon. Check back later!</p>
            </div>
        @endif
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-gray-50 border-t">
    <div class="mx-auto max-w-6xl px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Stay Connected</h2>
        <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
            Get the latest updates from Educate the Orphans delivered to your inbox.
        </p>
        <div class="mt-8">
            <a href="{{ route('home') }}#newsletter" class="inline-block rounded-lg bg-green-600 text-white px-6 py-3 font-semibold hover:bg-green-700">
                Subscribe to Updates
            </a>
        </div>
    </div>
</section>

@endsection
