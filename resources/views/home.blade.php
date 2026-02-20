@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    {{-- If you want to use your own image:
         put it in public/images/hero.jpg and change src to: {{ asset('images/hero.jpg') }} --}}
    <img
        src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="Education and community"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <p class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm">
                    Serving in Tharaka, Kenya
                </p>

                <h1 class="mt-4 text-5xl font-bold leading-tight">
                    Transforming Lives Through Education and Faith
                </h1>

                <p class="mt-5 text-lg text-gray-200">
                    Our mission is to feed, clothe, and educate destitute children—empowering them with hope and a future.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('donate') }}"
                       class="rounded-lg bg-white px-6 py-3 font-semibold text-black hover:bg-gray-200">
                        Donate Now
                    </a>
                    <a href="{{ route('projects') }}"
                       class="rounded-lg border border-white px-6 py-3 font-semibold hover:bg-white hover:text-black">
                        Explore Our Work
                    </a>
                </div>

                <p class="mt-6 text-sm text-gray-300">
                    100% of donations go toward programmes and services (update this line if your policy differs).
                </p>
            </div>
        </div>
    </div>
</section>

{{-- MISSION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4 grid gap-10 md:grid-cols-2 md:items-center">
        <div>
            <h2 class="text-3xl font-bold">Our Mission</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Educate the Orphans exists to care for vulnerable children and families through Christ-centered outreach,
                education support, and community development.
            </p>
            <p class="mt-4 text-gray-700 leading-relaxed">
                We believe education creates lasting change—breaking cycles of poverty and opening doors for future generations.
            </p>
            <div class="mt-7 flex gap-3">
                <a href="{{ route('about') }}" class="rounded-lg border px-5 py-3 font-semibold hover:bg-gray-50">
                    Learn About Educate the Orphans
                </a>
                <a href="{{ route('get-involved') }}" class="rounded-lg bg-black px-5 py-3 text-white font-semibold hover:bg-gray-800">
                    Get Involved
                </a>
            </div>
        </div>

        <div class="rounded-2xl border p-8 bg-gray-50">
            <p class="text-sm font-semibold text-gray-500">Guiding focus</p>
            <ul class="mt-4 space-y-3 text-gray-800">
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Child sponsorship & education support
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Community care & discipleship
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Clean water & practical help
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Rescue & rehabilitation (where applicable)
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- IMPACT STATS --}}
<section class="py-14 border-y bg-white">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 text-center">
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">1,000+</p>
                <p class="mt-2 text-gray-600">Children Supported</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">8</p>
                <p class="mt-2 text-gray-600">Schools Established</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">40,000+</p>
                <p class="mt-2 text-gray-600">People With Clean Water</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">200+</p>
                <p class="mt-2 text-gray-600">University Graduates</p>
            </div>
        </div>
        <p class="mt-6 text-sm text-gray-500 text-center">
            Replace these stats with your exact numbers anytime.
        </p>
    </div>
</section>

{{-- FEATURED PROJECTS --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 class="text-3xl font-bold">Featured Projects</h2>
                <p class="mt-3 text-gray-700 max-w-2xl">
                    Practical care that meets urgent needs while building long-term stability.
                </p>
            </div>
            <a href="{{ route('projects') }}" class="text-sm font-semibold hover:underline">
                View all projects →
            </a>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @php
                $projects = [
                    ['title' => 'Famine Relief', 'desc' => 'Emergency food support during drought and crisis.'],
                    ['title' => 'Clean Water', 'desc' => 'Reliable water access for families and communities.'],
                    ['title' => 'ETO Shamba (Farm)', 'desc' => 'Sustainable agriculture and skills training.'],
                    ['title' => 'Rescue & Care', 'desc' => 'Care and rehabilitation for vulnerable children.'],
                ];
            @endphp

            @foreach($projects as $p)
                <div class="rounded-2xl border p-6 hover:shadow-sm transition">
                    <p class="font-semibold text-lg">{{ $p['title'] }}</p>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $p['desc'] }}</p>
                    <a href="{{ route('projects') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">
                        Learn more →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- STORIES / TESTIMONIAL --}}
<section class="py-16 bg-gray-50 border-y">
    <div class="mx-auto max-w-6xl px-4 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <h2 class="text-3xl font-bold">Lives Changed</h2>
            <p class="mt-4 text-gray-700">
                Stories show the real impact—children graduating, families supported, and communities strengthened.
            </p>
            <div class="mt-7">
                <a href="{{ route('stories') }}" class="rounded-lg bg-black px-5 py-3 text-white font-semibold hover:bg-gray-800">
                    Read Stories
                </a>
            </div>
        </div>

        <div class="rounded-2xl border bg-white p-8">
            <p class="text-sm font-semibold text-gray-500">Featured Story</p>
            <blockquote class="mt-4 text-lg leading-relaxed">
                "Because of Educate the Orphans' support, I was able to stay in school and pursue my education.
                Today I’m building a different future for my family.”
            </blockquote>
            <p class="mt-4 text-sm text-gray-600">— Example Graduate (replace with real story)</p>
        </div>
    </div>
</section>

{{-- GET INVOLVED --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold">Get Involved</h2>
        <p class="mt-3 text-gray-700 max-w-2xl">
            There are many ways to join the mission—sponsor a child, give monthly, volunteer, or share our work.
        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Sponsor</p>
                <p class="mt-2 text-sm text-gray-600">Support a child’s education, supplies, and care.</p>
                <a href="{{ route('get-involved') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Learn more →</a>
            </div>

            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Give Monthly</p>
                <p class="mt-2 text-sm text-gray-600">Reliable support helps plan long-term impact.</p>
                <a href="{{ route('donate') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Donate →</a>
            </div>

            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Volunteer</p>
                <p class="mt-2 text-sm text-gray-600">Use your skills and time to strengthen the mission.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Contact us →</a>
            </div>
        </div>
    </div>
</section>

{{-- NEWSLETTER --}}
<section class="py-16 border-t">
    <div class="mx-auto max-w-6xl px-4">
        <div class="rounded-2xl border p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h3 class="text-2xl font-bold">Get updates from Educate the Orphans</h3>
                <p class="mt-2 text-gray-700">Monthly stories, project updates, and ways to help.</p>
            </div>

            {{-- For now this is a dummy form. Later we can wire it to Mailchimp or a DB table. --}}
            <form class="flex w-full md:w-auto gap-3">
                <input
                    type="email"
                    placeholder="you@email.com"
                    class="w-full md:w-72 rounded-lg border px-4 py-3"
                >
                <button
                    type="button"
                    class="rounded-lg bg-black px-5 py-3 text-white font-semibold hover:bg-gray-800"
                >
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
