@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1559027615-cd2628902d4a?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="Get Involved"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Get Involved</h1>
                <p class="mt-5 text-lg text-gray-200">Join us in transforming lives through education, care, and community support.</p>
            </div>
        </div>
    </div>
</section>

{{-- HOW TO GET INVOLVED --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <!-- Sponsor a Child -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Sponsor a Child</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Provide education, food, and care for a specific child. Build a direct relationship with meaningful updates and photos.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Monthly email updates</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Photos and progress reports</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Direct impact on one child's future</span>
                    </li>
                </ul>
                <a href="{{ route('donate') }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                    Sponsor Now
                </a>
            </div>

            <!-- Make a Donation -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Make a Donation</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Give a one-time gift or set up monthly giving. Every donation directly funds our programs and services.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>100% goes to programs</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Flexible donation options</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Tax receipts provided</span>
                    </li>
                </ul>
                <a href="{{ route('donate') }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                    Donate
                </a>
            </div>

            <!-- Volunteer & Partner -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Volunteer & Partner</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Use your skills, time, and passion. Partner with us for short-term projects or long-term involvement.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>In-country and remote opportunities</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Skills-based partnerships</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Corporate team projects</span>
                    </li>
                </ul>
                <a href="{{ route('contact') }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

{{-- PARTNERSHIP LEVELS --}}
<section class="py-16 bg-gray-50 border-y">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-10">Monthly Giving Levels</h2>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg">$25</p>
                <p class="mt-2 text-sm text-gray-600">Provides school supplies for a child</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg">$50</p>
                <p class="mt-2 text-sm text-gray-600">Supplies nutritious meals for a family</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg">$100</p>
                <p class="mt-2 text-sm text-gray-600">Provides monthly education support</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg">$250+</p>
                <p class="mt-2 text-sm text-gray-600">Supports community programs</p>
            </div>
        </div>
    </div>
</section>

{{-- PRAYER AND SHARING --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6">Other Ways to Help</h2>
        <div class="grid gap-8 md:grid-cols-2">
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-bold">Pray</h3>
                <p class="mt-3 text-gray-700">
                    Prayer is the foundation of our work. Sign up for our prayer letter and intercede for the children, families, and communities we serve.
                </p>
                <a href="#" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">Join our prayer network →</a>
            </div>

            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-bold">Share Our Story</h3>
                <p class="mt-3 text-gray-700">
                    Tell your friends and family about Educate the Orphans. Follow us on social media and share our updates to expand our community of supporters.
                </p>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">Facebook</a>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">Instagram</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-gray-50 border-t">
    <div class="mx-auto max-w-6xl px-4 text-center">
        <h2 class="text-3xl font-bold">Ready to Make a Difference?</h2>
        <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
            No matter how you choose to get involved, your support transforms lives. Start today.
        </p>
        <div class="mt-8 flex flex-wrap gap-3 justify-center">
            <a href="{{ route('donate') }}" class="rounded-lg bg-green-600 text-white px-6 py-3 font-semibold hover:bg-green-700">
                Donate or Sponsor
            </a>
            <a href="{{ route('contact') }}" class="rounded-lg border px-6 py-3 font-semibold hover:bg-gray-100">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
