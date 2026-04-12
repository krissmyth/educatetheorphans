@extends('layouts.public')

@section('title', 'Educate the Orphans — Transforming Lives Through Education in Kenya')
@section('meta_description', 'Educate the Orphans is a Christian charity feeding, clothing and educating orphaned and needy children in Tharaka, Kenya. 100% of donations go directly to our work.')

@section('content')

{{-- HERO --}}
<section class="relative">
    {{-- If you want to use your own image:
         put it in public/images/hero.jpg and change src to: {{ asset('images/hero.jpg') }} --}}
    <div class="relative h-[560px] w-full overflow-hidden">
        <!-- Main Image -->
        <img
            id="heroImage"
            src="{{ asset('images/home.jpg') }}"
            class="h-[560px] w-full object-cover"
            alt="Education and community"
        >
        
        <!-- Video Element (initially hidden, loaded lazily) -->
        <video
            id="heroVideo"
            class="absolute inset-0 h-[560px] w-full object-cover hidden"
            muted
            preload="none"
            poster="{{ asset('images/home.jpg') }}"
        >
            <source data-src="{{ asset('images/home_video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="absolute inset-0 bg-black/20"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <p class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-sm">
                    Serving needy and orphaned children in Tharaka, Kenya
                </p>

                <h1 class="mt-4 text-5xl font-bold leading-tight">
                    Transforming Children's Lives Through Education and Faith
                </h1>

                <p class="mt-5 text-lg text-gray-200">
                    Our mission is to feed, clothe, and educate orphaned and needy children to give them hope and a future (Jeremiah 29:11)
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
                    Every penny we receive goes directly to our work in Tharaka, Kenya.<br>
                    Our entire UK & Ireland team are volunteers, ensuring that all donations support those most in need.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- DONATION IMPACT STRIP --}}
<section class="bg-green-700 text-white py-4">
    <div class="mx-auto max-w-6xl px-4">
        <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2 text-sm text-center">
            <span class="font-semibold text-amber-300 uppercase tracking-wide text-xs">Your donation goes directly to:</span>
            <div class="flex items-center gap-1.5">
                <span class="text-amber-400 font-bold">£10</span>
                <span class="text-green-100">feeds a child for one week</span>
            </div>
            <span class="hidden sm:block text-green-500">·</span>
            <div class="flex items-center gap-1.5">
                <span class="text-amber-400 font-bold">£20</span>
                <span class="text-green-100">covers a month of schooling</span>
            </div>
            <span class="hidden sm:block text-green-500">·</span>
            <div class="flex items-center gap-1.5">
                <span class="text-amber-400 font-bold">£50</span>
                <span class="text-green-100">helps support a family for a month</span>
            </div>
            <span class="hidden sm:block text-green-500">·</span>
            <a href="{{ route('donate') }}" class="font-semibold text-amber-400 hover:text-amber-300 transition">
                Donate now →
            </a>
        </div>
    </div>
</section>

{{-- STATS STRIP --}}
<section class="bg-gray-50 border-b py-4">
    <div class="mx-auto max-w-6xl px-4">
        <div class="flex flex-wrap justify-center items-center gap-x-8 gap-y-2 text-sm text-center text-gray-700">
            <div class="flex items-center gap-2">
                <span class="font-bold text-gray-900">Since 1990</span>
                <span>serving Kenya's Tharaka region</span>
            </div>
            <span class="hidden sm:block text-gray-300">|</span>
            <div class="flex items-center gap-2">
                <span class="font-bold text-gray-900">3,000+</span>
                <span>children supported</span>
            </div>
            <span class="hidden sm:block text-gray-300">|</span>
            <div class="flex items-center gap-2">
                <span class="font-bold text-gray-900">7 schools</span>
                <span>across the region</span>
            </div>
            <span class="hidden sm:block text-gray-300">|</span>
            <div class="flex items-center gap-2">
                <span class="font-bold text-gray-900">60,000+</span>
                <span>people with clean water</span>
            </div>
        </div>
    </div>
</section>

{{-- SCRIPTURE STRIP --}}
<section class="bg-white border-b py-6">
    <div class="mx-auto max-w-3xl px-4 text-center">
        <p class="text-lg italic text-gray-700 leading-relaxed">
            "Religion that God our Father accepts as pure and faultless is this: to look after orphans and widows in their distress."
        </p>
        <p class="mt-2 text-sm font-semibold text-green-700">James 1:27</p>
    </div>
</section>

{{-- MISSION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4 grid gap-10 md:grid-cols-2 md:items-center">
        <div>
            <h2 class="text-3xl font-bold">Our Mission</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Educate the Orphans is committed to demonstrating God's love through action by supporting some of Africa's most impoverished children.
                We focus on addressing their practical needs, including providing food, clothing, and educational support.
            </p>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Through our work, we have seen how education can bring lasting change and break the cycle of poverty to create a brighter future
                for the children we serve, as well as for generations to come.
            </p>
            <div class="mt-7 flex gap-3">
                <a href="{{ route('about') }}" class="rounded-lg bg-black px-5 py-3 font-semibold text-white shadow-sm hover:bg-gray-800">
                    Learn About Educate the Orphans
                </a>
                <a href="{{ route('get-involved') }}" class="rounded-lg bg-black px-5 py-3 font-semibold text-white shadow-sm hover:bg-gray-800">
                    Get Involved
                </a>
            </div>
        </div>

        <div class="rounded-2xl border p-8 bg-gray-50">
            <p class="text-sm font-semibold text-gray-500">Our Core Focus:</p>
            <ul class="mt-4 space-y-3 text-gray-800">
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Demonstrating God's love through action
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Providing education for needy and orphaned children
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Providing a meal for every needy child in our schools
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Providing access to clean water
                </li>
                <li class="flex gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-black"></span>
                    Supporting the elderly with famine relief
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
                <p class="mt-2 text-gray-600">Children supported</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">7</p>
                <p class="mt-2 text-gray-600">Schools established</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">60,000+</p>
                <p class="mt-2 text-gray-600">People with clean water</p>
            </div>
            <div class="rounded-2xl border p-6">
                <p class="text-4xl font-bold">∞</p>
                <p class="mt-2 text-gray-600">Many lives changed</p>
            </div>
        </div>
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
                    ['id' => 'famine-relief', 'title' => 'Famine Relief', 'desc' => 'Emergency food support during drought and crisis.'],
                    ['id' => 'clean-water', 'title' => 'Clean Water', 'desc' => 'Reliable water access for families and communities.'],
                    ['id' => 'eto-shamba', 'title' => 'ETO Shamba (Farm)', 'desc' => 'Sustainable agriculture and skills training.'],
                    ['id' => 'rea-rescue', 'title' => 'Rescue & Care', 'desc' => 'Care and rehabilitation for vulnerable children.'],
                ];
            @endphp

            @foreach($projects as $p)
                <a href="{{ route('projects') }}#project-{{ $p['id'] }}" class="block rounded-2xl border p-6 hover:shadow-sm transition">
                    <p class="font-semibold text-lg">{{ $p['title'] }}</p>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $p['desc'] }}</p>
                    <span class="mt-4 inline-block text-sm font-semibold">Learn more →</span>
                </a>
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
                "Because of Educate the Orphans' support, I was able to stay in school and pursue my education. Today I’m a teacher with ETO.  I thank God as I could not have achieved my dream without ETO."
            </blockquote>
            <p class="mt-4 text-sm text-gray-600">— Purity Kathomi, Past Student & ETO Teacher</p>
        </div>
    </div>
</section>

{{-- GET INVOLVED --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold">Get Involved</h2>
        <p class="mt-3 text-gray-700 max-w-2xl">
            There are many ways you can join us in our mission.
        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Pray</p>
                <p class="mt-2 text-sm text-gray-600">Pray for our children, teachers, and ongoing work.</p>
                <a href="{{ route('get-involved') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Learn more →</a>
            </div>

            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Invite Us</p>
                <p class="mt-2 text-sm text-gray-600">Invite us to share our story with your church or small group.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Contact us →</a>
            </div>

            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Donate</p>
                <p class="mt-2 text-sm text-gray-600">Support our efforts through a one-time or monthly donation.</p>
                <a href="{{ route('donate') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Donate →</a>
            </div>

            <div class="rounded-2xl border p-6">
                <p class="font-semibold text-lg">Volunteer</p>
                <p class="mt-2 text-sm text-gray-600">Contact us if God is leading you to volunteer to work with us.</p>
                <a href="{{ route('contact') }}" class="mt-4 inline-block text-sm font-semibold hover:underline">Contact us →</a>
            </div>
        </div>
    </div>
</section>

{{-- NEWSLETTER --}}
<section class="py-16 border-t" id="newsletter">
    <div class="mx-auto max-w-6xl px-4">
        <div class="flex flex-col md:flex-row gap-8 md:gap-12 md:items-center">
            <!-- Left side: Text -->
            <div class="flex-1">
                <h3 class="text-3xl font-bold">Get updates from Educate the Orphans</h3>
                <p class="mt-6 text-gray-700">By subscribing to our mailing list, you can stay connected with us and up to date with all that God is doing through Educate the Orphans.</p>
                <p class="mt-4 text-gray-700">Our emails help you stay connected to the difference your prayers and support are making in the lives of vulnerable children and the communities we serve, with regular updates on our projects, encouraging testimonies, and specific prayer requests so you can continue to stand with us in this mission.</p>
            </div>

            <!-- Right side: Subscribe Form -->
            <div class="flex-1">
                <form action="https://eto-ministries.us20.list-manage.com/subscribe/post?u=4e19ab77a2020248a46932b37&amp;id=1010eefcd1&amp;f_id=004e5eeef0" method="post" target="_blank" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="mce-FNAME" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="FNAME" id="mce-FNAME" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="mce-LNAME" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="LNAME" id="mce-LNAME" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    <div>
                        <label for="mce-EMAIL" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="EMAIL" id="mce-EMAIL" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    {{-- Mailchimp honeypot (spam protection) --}}
                    <div aria-hidden="true" style="position: absolute; left: -5000px;">
                        <input type="text" name="b_4e19ab77a2020248a46932b37_1010eefcd1" tabindex="-1" value="">
                    </div>
                    <button type="submit"
                        class="rounded-lg bg-green-600 text-white px-6 py-2.5 font-semibold hover:bg-green-700 transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroImage = document.getElementById('heroImage');
    const heroVideo = document.getElementById('heroVideo');
    const videoSource = heroVideo.querySelector('source[data-src]');

    function loadAndPlayVideo() {
        // Set the real src so the browser starts loading the video
        if (videoSource.src !== videoSource.dataset.src) {
            videoSource.src = videoSource.dataset.src;
            heroVideo.load();
        }

        heroVideo.addEventListener('canplay', function onCanPlay() {
            heroVideo.removeEventListener('canplay', onCanPlay);
            heroImage.classList.add('hidden');
            heroVideo.classList.remove('hidden');
            heroVideo.play();
        }, { once: true });
    }

    // Defer video load until browser is idle (or fall back to 4s timeout)
    function scheduleVideoLoad() {
        if ('requestIdleCallback' in window) {
            requestIdleCallback(loadAndPlayVideo, { timeout: 4000 });
        } else {
            setTimeout(loadAndPlayVideo, 4000);
        }
    }

    scheduleVideoLoad();

    // When video ends, show image again
    heroVideo.addEventListener('ended', function() {
        heroVideo.classList.add('hidden');
        heroImage.classList.remove('hidden');
    });
});
</script>

@endsection
