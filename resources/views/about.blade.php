@extends('layouts.public')

@section('title', 'About Us - Educate the Orphans')
@section('meta_description', 'Learn about Educate the Orphans — a Christian charity working since 1990 to feed, clothe and educate orphaned and needy children across 7 schools in Tharaka, Kenya.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/about.jpg') }}"
        class="h-[320px] sm:h-[560px] w-full object-cover"
        alt="About Educate the Orphans"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-end pb-12">
            <div class="max-w-2xl text-white">
                <h1 class="text-3xl sm:text-5xl font-bold leading-tight">About Educate the Orphans</h1>
                <p class="mt-3 text-base sm:text-lg text-gray-200">Transforming Lives Through Education and Care</p>
            </div>
        </div>
    </div>
</section>

{{-- MISSION & APPROACH --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4 grid gap-10 md:grid-cols-2 md:items-center">
        <div>
            <h2 class="text-3xl font-bold">Our Mission</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Educate the Orphans is a Christian charity operating in Kenya, committed to supporting orphaned and vulnerable children.
            </p>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Our mission is to demonstrate the love of Jesus through practical action. We do this by providing children with essential needs such as food, clothing, and access to education. We have also established two rescue centres that offer safe shelter for children who have escaped human trafficking, child marriage, and abuse.
            </p>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Alongside this, we partner with extended families, enabling children to be cared for within their communities while providing the financial support needed to ensure they receive proper nutrition, adequate clothing, and a quality education.
            </p>
        </div>

        <div class="rounded-2xl border p-8 bg-gray-50">
            <h2 class="text-3xl font-bold">Our Approach</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                We believe in sustainable, family-centered solutions. Children remain with their families and extended relatives while we cover the costs of their care and education. This approach:
            </p>
            <ul class="mt-4 space-y-3 text-gray-800">
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Maintains family bonds and cultural connections
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Supports entire family units
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Builds strong community relationships
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Ensures lasting impact and stability
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- IMPACT STATS --}}
<section class="py-14 border-y bg-white">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 text-center">
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">Since 1990</p>
                <p class="mt-2 text-gray-600">Working in Kenya's Tharaka region for over 30 years</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">7 Schools</p>
                <p class="mt-2 text-gray-600">Operating education programmes across multiple locations</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">3,000+ Children</p>
                <p class="mt-2 text-gray-600">Currently receiving an education in our schools</p>
            </div>
        </div>
    </div>
</section>

{{-- SUCCESS STORIES LIST --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-4 text-center">Success Stories</h2>
        <p class="text-gray-700 leading-relaxed text-center max-w-2xl mx-auto mb-10">
            The true measure of our success is visible in the lives of those we've helped. Many former beneficiaries of Educate the Orphans are now fully employed in meaningful roles:
        </p>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-2xl border bg-white p-6 hover:shadow-md transition">
                <div class="text-3xl mb-3">📖</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Teachers</h3>
                <p class="text-gray-600 text-sm">Former beneficiaries now educating the next generation in Kenyan schools and communities.</p>
            </div>
            <div class="rounded-2xl border bg-white p-6 hover:shadow-md transition">
                <div class="text-3xl mb-3">⛪</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Pastors & Clergy</h3>
                <p class="text-gray-600 text-sm">Spiritual leaders serving their churches and communities across the Tharaka region.</p>
            </div>
            <div class="rounded-2xl border bg-white p-6 hover:shadow-md transition">
                <div class="text-3xl mb-3">🏛️</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Government Officials</h3>
                <p class="text-gray-600 text-sm">Individuals serving at county and national government levels, shaping policy in Kenya.</p>
            </div>
            <div class="rounded-2xl border bg-white p-6 hover:shadow-md transition">
                <div class="text-3xl mb-3">🌟</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Presidential Office</h3>
                <p class="text-gray-600 text-sm">Some students have risen to work directly with Kenya's presidential office.</p>
            </div>
            <div class="rounded-2xl border bg-white p-6 hover:shadow-md transition col-span-full sm:col-span-1 lg:col-span-2">
                <div class="text-3xl mb-3">💬</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Lasting Impact</h3>
                <p class="text-gray-600 text-sm">These individuals represent the power of education to break cycles of poverty — not just for themselves, but for their own families and future generations.</p>
            </div>
        </div>
    </div>
</section>

{{-- REGISTRATION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6">How We're Registered</h2>
        <p class="text-gray-700 leading-relaxed max-w-3xl">
            Educate the Orphans is a registered charity in the United Kingdom, overseen by the Charity Commission for Northern Ireland (Charity no. 102736).
        </p>
        <p class="mt-4 text-gray-700 leading-relaxed max-w-3xl">
            Our registration ensures full transparency and accountability in how we manage resources — so you can give with confidence, knowing your support is in safe hands.
        </p>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6">How You Can Help</h2>
        <div class="flex flex-col lg:flex-row lg:items-start lg:gap-12">
            <div class="flex-1">
                <p class="text-gray-700 leading-relaxed">
                    We no longer operate individual child sponsorship. With so many children in need, we could never turn a child away simply because no sponsor had been found for them. Donations given for a specific project are used exactly for that purpose, while general donations are shared across all the children in our care — ensuring no child is left behind.
                </p>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    We trust that God will provide exactly what is needed, and He never lets us down. Your generosity, however large or small, is part of that provision — and it makes a real difference to every child we serve.
                </p>
            </div>
            <div class="mt-6 lg:mt-0 flex flex-col items-center lg:items-start gap-2 shrink-0">
                <p class="font-semibold text-gray-900">Support our work in Kenya</p>
                <script src="https://www.justgiving.com/widgets/scripts/widget.js"
                    data-version="2"
                    data-widgetType="donateButton"
                    data-linkType="givingCheckout"
                    data-donateButtonType="justgivingSmall"
                    data-linkId="if1ko20cql"
                    data-marketCode="GB"
                    data-showPaymentLogos="true"
                    data-popupCheckout="true"
                    type="text/javascript"></script>
                <p class="text-xs text-gray-500">🔒 Secure checkout — no need to leave this page</p>
                <div class="mt-1 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2 text-center w-64">
                    <p class="text-xs font-semibold text-amber-800">🇬🇧 UK taxpayer?</p>
                    <p class="text-xs text-amber-700 mt-0.5">Your donation is worth <strong>25% more</strong> at no extra cost through Gift Aid</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
