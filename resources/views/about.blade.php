@extends('layouts.public')

@section('title', 'About Us - Educate the Orphans')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="About Educate the Orphans"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">About Educate the Orphans</h1>
                <p class="mt-5 text-lg text-gray-200">Transforming Lives Through Education and Care</p>
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
                Educate the Orphans is a small, Christian charity working in Kenya to support orphaned and needy children. Our mission is simple yet profound: to feed, clothe, and educate destitute children, with a strong emphasis on education.
            </p>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Rather than operating a traditional orphanage, we partner with extended families to care for children while providing the financial support needed to ensure they receive proper nutrition, clothing, and quality education.
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
                <p class="mt-2 text-gray-600">Currently supported and receiving care and education</p>
            </div>
        </div>
    </div>
</section>

{{-- SUCCESS STORIES LIST --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6 text-center">Success Stories</h2>
        <p class="text-gray-700 leading-relaxed text-center max-w-2xl mx-auto">
            The true measure of our success is visible in the lives of those we've helped. Many former beneficiaries of Educate the Orphans are now fully employed in meaningful roles, including:
        </p>
        <ul class="mt-8 space-y-3 text-gray-800 max-w-2xl mx-auto">
            <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                Teachers educating the next generation
            </li>
            <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                Pastors serving their communities
            </li>
            <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                Government officials at county and national levels
            </li>
            <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                Clergy members in their churches
            </li>
            <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                Professionals working with Kenya's presidential office
            </li>
        </ul>
        <p class="mt-6 text-gray-700 text-center max-w-2xl mx-auto">
            These individuals represent the lasting impact of education and support on children's futures.
        </p>
    </div>
</section>

{{-- REGISTRATION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6">How We're Registered</h2>
        <p class="text-gray-700 leading-relaxed">
            Educate the Orphans is a registered charity with legitimacy and accountability across multiple regions:
        </p>
        <ul class="mt-4 list-disc list-inside text-gray-700 space-y-2">
            <li><strong>UK Registration:</strong> Registered UK Charity</li>
            <li><strong>Ireland Registration:</strong> Registered Irish Charity</li>
            <li><strong>Kenya Registration:</strong> Registered in Kenya (Charity no. 102736 in Northern Ireland)</li>
        </ul>
        <p class="mt-4 text-gray-700">
            Our registration ensures transparency, accountability, and trust in how we manage resources and serve our community.
        </p>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-6">How You Can Help</h2>
        <p class="text-gray-700 leading-relaxed">
            Your support makes a direct, measurable difference in children's lives. We offer several ways to get involved:
        </p>
        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <div>
                <h4 class="text-xl font-semibold">Child Sponsorship</h4>
                <p class="mt-2 text-gray-700 leading-relaxed">
                    Sponsor a child and provide ongoing support for their education, nutrition, and care. We encourage direct communication with the children you support.
                </p>
            </div>
            <div>
                <h4 class="text-xl font-semibold">Donations</h4>
                <p class="mt-2 text-gray-700 leading-relaxed">
                    Make a one-time or recurring donation to support our programmes and reach more children in need.
                </p>
            </div>
        </div>
        <p class="mt-8 text-center">
            <a href="https://justgiving.com/educatetheorphans/donate" class="rounded-lg bg-black px-6 py-3 text-white font-semibold hover:bg-gray-800" target="_blank">Make a Donation</a>
        </p>
    </div>
</section>

@endsection
