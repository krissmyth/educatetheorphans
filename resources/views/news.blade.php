@extends('layouts.public')

@section('title', 'News & Updates - Educate the Orphans')
@section('meta_description', 'Stay up to date with the latest news, prayer requests, and project updates from Educate the Orphans and their work in Tharaka, Kenya.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/News.jpg') }}"
        class="h-[620px] sm:h-[560px] w-full object-cover"
        alt="News and Updates"
    >
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/10 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-start pt-12">
            <div class="flex flex-col md:flex-row md:items-start gap-8 w-full">

                {{-- Left: Title & description --}}
                <div class="max-w-lg text-white">
                    <h1 class="text-3xl sm:text-5xl font-bold leading-tight">News & Updates</h1>
                    <p class="mt-3 text-base sm:text-lg text-gray-200">Stay informed about our latest initiatives, stories, and impact updates from the field.</p>
                </div>

                {{-- Right: Subscribe form --}}
                <div class="md:ml-auto w-full md:max-w-sm bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-6">
                    <h2 class="text-lg font-bold text-white mb-1">Subscribe to Updates</h2>
                    <p class="text-xs text-gray-300 mb-4">Subscribe to stay connected with us and up to date with all that God is doing through Educate the Orphans.</p>
                    <form action="https://eto-ministries.us20.list-manage.com/subscribe/post?u=4e19ab77a2020248a46932b37&amp;id=1010eefcd1&amp;f_id=004e5eeef0" method="post" target="_blank" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="news-FNAME" class="block text-xs font-medium text-gray-200 mb-1">First Name <span class="text-red-400">*</span></label>
                                <input type="text" name="FNAME" id="news-FNAME" required
                                    class="w-full rounded-lg border border-white/30 bg-white/20 text-white placeholder-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                            <div>
                                <label for="news-LNAME" class="block text-xs font-medium text-gray-200 mb-1">Last Name <span class="text-red-400">*</span></label>
                                <input type="text" name="LNAME" id="news-LNAME" required
                                    class="w-full rounded-lg border border-white/30 bg-white/20 text-white placeholder-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>
                        <div>
                            <label for="news-EMAIL" class="block text-xs font-medium text-gray-200 mb-1">Email Address <span class="text-red-400">*</span></label>
                            <input type="email" name="EMAIL" id="news-EMAIL" required
                                class="w-full rounded-lg border border-white/30 bg-white/20 text-white placeholder-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        {{-- Mailchimp honeypot (spam protection) --}}
                        <div aria-hidden="true" style="position: absolute; left: -5000px;">
                            <input type="text" name="b_4e19ab77a2020248a46932b37_1010eefcd1" tabindex="-1" value="">
                        </div>
                        <button type="submit"
                            class="w-full rounded-lg bg-green-600 text-white px-4 py-2.5 font-semibold hover:bg-green-700 transition text-sm">
                            Subscribe
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- NEWS LISTING --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        @if ($items->isNotEmpty())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $item)
                    <a href="{{ route('news.show', $item->id) }}" class="group block border rounded-lg overflow-hidden hover:shadow-lg transition">
                        <!-- Featured Image -->
                        <div class="relative h-48 overflow-hidden bg-gray-200">
                            @if ($item->featured_image)
                                <img
                                    src="{{ $item->featured_image }}"
                                    alt="{{ $item->title }}"
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
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition line-clamp-2 mb-2">
                                {{ $item->title }}
                            </h3>

                            @if ($item->preview)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $item->preview }}</p>
                            @endif

                            @if ($item->sent_at)
                                <p class="text-xs text-gray-500 mb-4">
                                    {{ $item->sent_at->format('M j, Y') }}
                                </p>
                            @endif

                            <div class="text-green-600 font-semibold group-hover:text-green-700 transition">
                                Read More →
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">No updates yet</h3>
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
