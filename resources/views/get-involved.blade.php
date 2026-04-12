@extends('layouts.public')

@section('title', 'Get Involved - Educate the Orphans')
@section('meta_description', 'Find out how you can support Educate the Orphans — pray, donate, volunteer, invite us to speak, or partner with us to transform children\'s lives in Kenya.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/get-involved.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="Get Involved"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-end pb-12">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Get Involved</h1>
                <p class="mt-4 text-lg text-gray-200">Join us in transforming lives through education, care, and community support.</p>
            </div>
        </div>
    </div>
</section>

{{-- HOW TO GET INVOLVED --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <!-- Support Our Work -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Support Our Work</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Your donation goes directly to the children and families we serve. Every gift — however large or small — makes a real difference.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>100% reaches those in need</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>No child is ever turned away</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Our entire UK & Ireland team are volunteers</span>
                    </li>
                </ul>
                <div class="mt-6 text-center">
                    <a href="{{ route('donate') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                        Donate Now
                    </a>
                </div>
            </div>

            <!-- Pray -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Pray for Our Work</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Prayer is at the heart of everything we do. Join us in lifting up the children, families, teachers, and communities we serve in Kenya.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Pray for the children in our care</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Pray for our teachers and staff</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Pray for the families and communities</span>
                    </li>
                </ul>
                <div class="mt-6 flex flex-col items-center gap-2">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=https%3A%2F%2Fchat.whatsapp.com%2FDGiYTyGNo1CBfaEaBtTYRT%3Fmode%3Dgi_t"
                        alt="Scan to join ETO Prayer WhatsApp Group"
                        class="rounded-lg border p-1"
                        width="160" height="160"
                    >
                    <p class="text-xs text-gray-500">Scan with your phone camera to join</p>
                    <a href="https://chat.whatsapp.com/DGiYTyGNo1CBfaEaBtTYRT?mode=gi_t" target="_blank" rel="noopener" class="text-sm font-semibold text-green-600 hover:underline">
                        Or tap here to join →
                    </a>
                </div>
            </div>

            <!-- Invite Us -->
            <div class="border rounded-2xl p-8 hover:shadow-lg transition">
                <h3 class="text-2xl font-bold">Invite Us to Speak</h3>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Would you like someone from Educate the Orphans to speak at your church, school, or event? We would love to share what God is doing in Kenya.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Church services and mission events</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Schools and youth groups</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-green-600 font-bold">✓</span>
                        <span>Fundraising and awareness events</span>
                    </li>
                </ul>
                <div class="mt-6 text-center">
                    <a href="{{ route('contact') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700">
                        Get in Touch
                    </a>
                </div>
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
                <p class="font-semibold text-lg text-amber-500">£5</p>
                <p class="mt-2 text-sm text-gray-600">Feeds a child for one week</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg text-amber-500">£20</p>
                <p class="mt-2 text-sm text-gray-600">Covers a month of schooling</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg text-amber-500">£50</p>
                <p class="mt-2 text-sm text-gray-600">Supports a family for a month</p>
            </div>
            <div class="rounded-lg border p-6 bg-white">
                <p class="font-semibold text-lg text-amber-500">£100+</p>
                <p class="mt-2 text-sm text-gray-600">Supports community programmes</p>
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
                <div class="mt-4 flex gap-4">
                    <a href="https://www.facebook.com/EducatetheOrphans" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 transition" title="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
<a href="https://www.youtube.com/channel/UCwqCS6I8bGI16yf1iM0h7dw?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-red-600 transition" title="YouTube">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
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
                Donate Now
            </a>
            <a href="{{ route('contact') }}" class="rounded-lg border px-6 py-3 font-semibold hover:bg-gray-100">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
