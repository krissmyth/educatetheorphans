@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/Stories.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="Stories of Change"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Lives Changed</h1>
                <p class="mt-5 text-lg text-gray-200">Real stories of children and families transformed through education, care, and community support.</p>
            </div>
        </div>
    </div>
</section>

{{-- STORIES GRID --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($stories as $story)
                <article class="border rounded-lg overflow-hidden hover:shadow-lg transition group">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img 
                            src="{{ asset('images/stories/' . $story['image']) }}" 
                            alt="{{ $story['title'] }}"
                            class="h-full w-full object-cover object-top group-hover:scale-105 transition duration-300"
                        >
                    </div>
                    <div class="p-6">
                        <p class="text-sm font-semibold text-{{ $story['category_color'] }}-600 mb-2">{{ $story['category'] }}</p>
                        <h3 class="text-lg font-bold">{{ $story['title'] }}</h3>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            {{ $story['description'] }}
                        </p>
                        <p class="mt-4 text-xs text-gray-500 italic">"{{ $story['quote'] }}"</p>
                    </div>
                </article>
            @endforeach

        </div>
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
                <p class="text-4xl font-bold text-blue-600">200+</p>
                <p class="mt-2 text-gray-700">University graduates from Educate the Orphans programmes</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-bold text-purple-600">40,000+</p>
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
                Sponsor a Child
            </a>
            <a href="{{ route('donate') }}" class="rounded-lg border px-6 py-3 font-semibold hover:bg-gray-100">
                Make a Donation
            </a>
        </div>
    </div>
</section>

@endsection
