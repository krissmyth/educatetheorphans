@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=2000&q=80"
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

            <!-- Story 1 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1503454537688-e6694fdbb9e1?auto=format&fit=crop&w=600&q=80" alt="Maria's Story" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-blue-600 mb-2">Featured Story</p>
                    <h3 class="text-lg font-bold">Maria's Journey to University</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Sponsored since age 8, Maria stayed in school through ETO's support. Now she's in university studying to become a teacher and give back to her community.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"ETO believed in me when I didn't believe in myself."</p>
                </div>
            </article>

            <!-- Story 2 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&q=80" alt="Samuel's Story" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-green-600 mb-2">Impact Story</p>
                    <h3 class="text-lg font-bold">Samuel: From Orphan to Teacher</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Rescued from the streets as a child, Samuel received education and care through ETO. He's now a teacher mentoring vulnerable children.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"I teach because I remember what it feels like to be forgotten."</p>
                </div>
            </article>

            <!-- Story 3 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1594643987237-36876b5e23e4?auto=format&fit=crop&w=600&q=80" alt="Water Project" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-purple-600 mb-2">Community Impact</p>
                    <h3 class="text-lg font-bold">A Village Gets Clean Water</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        When ETO drilled wells in Mwambi village, children finally had water for school instead of spending hours collecting it. Enrollment doubled.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"Clean water changed everything for us."</p>
                </div>
            </article>

            <!-- Story 4 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1427504494785-cdba58dabf8d?auto=format&fit=crop&w=600&q=80" alt="School Hope" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-orange-600 mb-2">Education</p>
                    <h3 class="text-lg font-bold">Hope School Opens Doors</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Hope ETO School, started in 2010, now educates 450 children annually. Many graduates have gone to secondary school and beyond.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"Education is the foundation of everything."</p>
                </div>
            </article>

            <!-- Story 5 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?auto=format&fit=crop&w=600&q=80" alt="Farm Success" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-green-600 mb-2">Sustainability</p>
                    <h3 class="text-lg font-bold">ETO Shamba Transforms Livelihoods</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Youth trained on ETO's farm now have sustainable income. They support their families while feeding emergency relief efforts during droughts.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"I have hope for the future now."</p>
                </div>
            </article>

            <!-- Story 6 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1576091160550-112173faf246?auto=format&fit=crop&w=600&q=80" alt="Community Care" class="h-48 w-full object-cover">
                <div class="p-6">
                    <p class="text-sm font-semibold text-indigo-600 mb-2">Community</p>
                    <h3 class="text-lg font-bold">Prayer and Discipleship Transform a Village</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Through Christ-centered community programs, families have experienced healing, hope, and restoration. The gospel is changing hearts and communities.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"We finally feel valued and loved."</p>
                </div>
            </article>

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
                <p class="mt-2 text-gray-700">University graduates from ETO programs</p>
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
