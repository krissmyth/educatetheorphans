@extends('layouts.public')

@section('title', 'Our Projects - Educate the Orphans')
@section('meta_description', 'Explore Educate the Orphans\' projects including famine relief, clean water access, the ETO Shamba farm, and rescue and care for vulnerable children in Kenya.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/projects.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="Our Projects"
    >
    <div class="absolute inset-0 bg-gradient-to-b from-black/65 via-black/20 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-start pt-12">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Our Projects and Programmes</h1>
                <p class="mt-4 text-lg text-gray-200">Transforming lives through education, care, and sustainable community development</p>
            </div>
        </div>
    </div>
</section>

{{-- PROJECTS INTRODUCTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl font-bold">Practical Faith in Action</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                Educate the Orphans operate a comprehensive range of programmes designed to meet the urgent needs of vulnerable children and families in the Tharaka region of Kenya. Each project works together to help create lasting change in the lives of vulnerable children.
            </p>
        </div>

        {{-- PROJECTS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="rounded-2xl border bg-white hover:shadow-lg transition group overflow-hidden">
                    <div class="aspect-video w-full overflow-hidden">
                        <img 
                            src="{{ asset('images/projects/' . $project['image']) }}" 
                            alt="{{ $project['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        >
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition mb-3">
                            {{ $project['title'] }}
                        </h3>
                        <p class="text-gray-700 text-sm leading-relaxed mb-4">
                            {{ $project['description'] }}
                        </p>
                        <a href="#project-{{ $project['id'] }}" class="text-green-600 font-semibold text-sm hover:text-green-700">
                            Learn more →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- DETAILED PROJECT SECTIONS --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        @foreach ($projects as $index => $project)
            <div id="project-{{ $project['id'] }}" class="scroll-mt-24 {{ $index !== count($projects) - 1 ? 'mb-16 pb-16 border-b' : '' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    {{-- Image --}}
                    <div class="{{ $index % 2 === 1 ? 'order-2' : '' }}">
                        <div class="rounded-2xl overflow-hidden shadow-lg">
                            <img 
                                src="{{ asset('images/projects/' . $project['image']) }}" 
                                alt="{{ $project['title'] }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="{{ $index % 2 === 1 ? 'order-1' : '' }}">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $project['title'] }}</h3>
                        <div class="text-gray-700 leading-relaxed mb-6 text-lg space-y-4">
                            {!! $project['long_description'] !!}
                        </div>
                        <div class="bg-white rounded-lg p-6 border-l-4 border-green-600">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Impact</p>
                            <p class="text-lg font-semibold text-gray-900 mt-2">{{ $project['impact'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="rounded-2xl bg-gradient-to-r from-green-600 to-emerald-600 p-10 md:p-16 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Support Our Work in Kenya</h2>
            <p class="text-lg text-green-50 max-w-2xl mx-auto mb-8 leading-relaxed">
                Our work depends on the generosity of people like you. Whether you give towards a specific project or to our general fund, your donation goes directly to the children and families we serve in Tharaka, Kenya. We trust that God will provide exactly what is needed — and He never lets us down.
            </p>
            <div class="flex flex-col items-center gap-3">
                <p class="font-semibold text-white">Donate securely below</p>
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
                <p class="text-xs text-green-100">🔒 Secure checkout — no need to leave this page</p>
                <div class="mt-1 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2 text-center">
                    <p class="text-xs font-semibold text-amber-800">🇬🇧 UK taxpayer?</p>
                    <p class="text-xs text-amber-700 mt-0.5">Your donation is worth <strong>25% more</strong> at no extra cost through Gift Aid</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- IMPACT OVERVIEW --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Our Collective Impact</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">3,000+</p>
                <p class="mt-3 text-gray-700 font-semibold">Children Educated in our Schools</p>
            </div>
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">7</p>
                <p class="mt-3 text-gray-700 font-semibold">Schools Operating</p>
            </div>
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">60,000+</p>
                <p class="mt-3 text-gray-700 font-semibold">People With Clean Water</p>
            </div>
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">30+</p>
                <p class="mt-3 text-gray-700 font-semibold">Years of Service</p>
            </div>
        </div>
    </div>
</section>

@endsection
