@extends('layouts.public')

@section('title', 'Stories - Educate the Orphans')
@section('meta_description', 'Read inspiring stories of children whose lives have been transformed through education and support from Educate the Orphans in Tharaka, Kenya.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/Stories.jpg') }}"
        class="h-[320px] sm:h-[560px] w-full object-cover"
        alt="Stories of Change"
    >
    <div class="absolute inset-0 bg-gradient-to-b from-black/65 via-black/20 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-start pt-12">
            <div class="max-w-2xl text-white">
                <h1 class="text-3xl sm:text-5xl font-bold leading-tight">Lives Changed</h1>
                <p class="mt-3 text-base sm:text-lg text-gray-200">Real stories of children and families transformed through education, care, and community support.</p>
            </div>
        </div>
    </div>
</section>

{{-- STORY CARDS — click to jump to full story below --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($stories as $story)
                <a href="#story-{{ $story['id'] }}" class="block border rounded-lg overflow-hidden hover:shadow-lg transition group">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        @if(isset($story['youtube_id']))
                            <img
                                src="https://img.youtube.com/vi/{{ $story['youtube_id'] }}/hqdefault.jpg"
                                alt="{{ $story['title'] }}"
                                class="h-full w-full object-cover group-hover:scale-105 transition duration-300"
                            >
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-black/50 rounded-full p-4 group-hover:bg-black/70 transition">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        @else
                            <img
                                src="{{ asset('images/stories/' . $story['image']) }}"
                                alt="{{ $story['title'] }}"
                                class="h-full w-full object-cover object-top group-hover:scale-105 transition duration-300"
                            >
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-sm font-semibold text-{{ $story['category_color'] }}-600 mb-2">{{ $story['category'] }}</p>
                        <h3 class="text-lg font-bold group-hover:text-green-600 transition">{{ $story['title'] }}</h3>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ $story['card_description'] ?? $story['description'] }}</p>
                        <p class="mt-4 text-sm font-semibold text-green-600">
                            {{ isset($story['youtube_id']) ? 'Watch story →' : 'Read story →' }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- INDIVIDUAL STORY SECTIONS --}}
<section class="py-16 bg-gray-50 border-t">
    <div class="mx-auto max-w-6xl px-4">
        @foreach ($stories as $index => $story)
            <div id="story-{{ $story['id'] }}" class="scroll-mt-24 {{ $index !== 0 ? 'mt-16 pt-16 border-t' : '' }}">

                @if(isset($story['youtube_id']))
                    {{-- Video story --}}
                    <p class="text-sm font-semibold text-teal-600 mb-2">{{ $story['category'] }}</p>
                    <h2 class="text-3xl font-bold mb-6">{{ $story['title'] }}</h2>
                    <div class="aspect-video w-full rounded-xl overflow-hidden shadow-md">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube-nocookie.com/embed/{{ $story['youtube_id'] }}"
                            title="{{ $story['title'] }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <p class="mt-6 text-gray-700 leading-relaxed text-lg">{{ $story['description'] }}</p>
                    <p class="mt-4 text-gray-500 italic border-l-4 border-teal-500 pl-4">"{{ $story['quote'] }}"</p>

                @else
                    {{-- Image story --}}
                    @if(isset($story['image_child']))
                        {{-- Two-photo layout: child photo + job photo side by side, then text below --}}
                        <p class="text-sm font-semibold text-{{ $story['category_color'] }}-600 mb-2">{{ $story['category'] }}</p>
                        <h2 class="text-3xl font-bold mb-6">{{ $story['title'] }}</h2>
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-full h-80 rounded-xl shadow-md overflow-hidden">
                                    <img
                                        src="{{ asset('images/stories/' . $story['image_child']) }}"
                                        alt="{{ $story['title'] }} as a child"
                                        class="w-full h-full object-cover object-top"
                                    >
                                </div>
                                <p class="text-xs text-gray-500 italic">{{ $story['image_child_caption'] ?? 'As a child' }}</p>
                            </div>
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-full h-80 rounded-xl shadow-md overflow-hidden">
                                    <img
                                        src="{{ asset('images/stories/' . $story['image']) }}"
                                        alt="{{ $story['title'] }} today"
                                        class="w-full h-full object-cover object-top"
                                    >
                                </div>
                                <p class="text-xs text-gray-500 italic">{{ $story['image_caption'] ?? 'Today' }}</p>
                            </div>
                        </div>
                        @foreach(explode("\n\n", $story['description']) as $paragraph)
                            <p class="text-gray-700 leading-relaxed mb-4">{{ $paragraph }}</p>
                        @endforeach
                        <p class="mt-6 text-gray-600 italic border-l-4 border-green-600 pl-4">"{{ $story['quote'] }}"</p>
                    @else
                        {{-- Single image layout --}}
                        <div class="grid md:grid-cols-2 gap-10 items-center">
                            <div class="{{ $index % 2 === 0 ? 'md:order-2' : '' }}">
                                <img
                                    src="{{ asset('images/stories/' . $story['image']) }}"
                                    alt="{{ $story['title'] }}"
                                    class="w-full rounded-xl shadow-md object-cover"
                                >
                            </div>
                            <div class="{{ $index % 2 === 0 ? 'md:order-1' : '' }}">
                                <p class="text-sm font-semibold text-{{ $story['category_color'] }}-600 mb-2">{{ $story['category'] }}</p>
                                <h2 class="text-3xl font-bold">{{ $story['title'] }}</h2>
                                <p class="mt-4 text-gray-700 leading-relaxed">{{ $story['description'] }}</p>
                                <p class="mt-6 text-gray-600 italic border-l-4 border-green-600 pl-4">"{{ $story['quote'] }}"</p>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        @endforeach
    </div>
</section>

{{-- IMPACT SUMMARY --}}
<section class="py-16 bg-gray-50 border-y">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-10 text-center">Every Story Matters</h2>
        <div class="grid gap-8 md:grid-cols-3">
            <div class="text-center">
                <p class="text-4xl font-bold text-green-600">1,000+</p>
                <p class="mt-2 text-gray-700">Children with changed futures</p>
            </div>
            <div class="text-center">
                <p class="text-6xl font-bold text-blue-600">∞</p>
                <p class="mt-2 text-gray-700">Many lives changed</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-bold text-purple-600">60,000+</p>
                <p class="mt-2 text-gray-700">People accessing clean water</p>
            </div>
        </div>
        <p class="mt-10 text-center text-gray-700 max-w-2xl mx-auto">
            These aren't just statistics—they're real people with real dreams. Your support makes stories like these possible every single day.
        </p>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4 text-center">
        <h2 class="text-3xl font-bold">Be Part of Someone's Story</h2>
        <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
            Every child deserves the chance to dream. Every family deserves hope. Join us in making transformation possible.
        </p>
        <div class="mt-8 flex flex-wrap gap-3 justify-center">
            <a href="{{ route('get-involved') }}" class="rounded-lg bg-green-600 text-white px-6 py-3 font-semibold hover:bg-green-700">
                Get Involved
            </a>
            <a href="{{ route('donate') }}" class="rounded-lg border px-6 py-3 font-semibold hover:bg-gray-100">
                Make a Donation
            </a>
        </div>
    </div>
</section>

@endsection
