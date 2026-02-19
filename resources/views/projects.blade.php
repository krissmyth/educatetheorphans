@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1559027615-cd02920f8f58?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="Our Projects"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Our Projects and Programs</h1>
                <p class="mt-5 text-lg text-gray-200">Transforming lives through education, care, and sustainable community development</p>
            </div>
        </div>
    </div>
</section>

{{-- PROJECTS INTRODUCTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl font-bold">Our Work in Action</h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
                We operate a comprehensive range of programs designed to meet the urgent needs of vulnerable children and families in the Tharaka region of Kenya. Each project works together to create lasting change.
            </p>
        </div>

        {{-- PROJECTS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition group">
                    <div class="text-4xl mb-4">{{ $project['icon'] }}</div>
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
            @endforeach
        </div>
    </div>
</section>

{{-- DETAILED PROJECT SECTIONS --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-6xl px-4">
        @foreach ($projects as $index => $project)
            <div id="project-{{ $project['id'] }}" class="mb-16 pb-16 {{ $index !== count($projects) - 1 ? 'border-b' : '' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    {{-- Image/Icon --}}
                    <div class="{{ $index % 2 === 1 ? 'order-2' : '' }}">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-12 flex items-center justify-center min-h-[300px]">
                            <div class="text-9xl opacity-80">{{ $project['icon'] }}</div>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="{{ $index % 2 === 1 ? 'order-1' : '' }}">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $project['title'] }}</h3>
                        <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                            {{ $project['long_description'] }}
                        </p>
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
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Support Our Work</h2>
            <p class="text-lg text-green-50 max-w-2xl mx-auto mb-8 leading-relaxed">
                Every project depends on generous supporters who believe in the power of education and community development. Your donation directly funds these initiatives and transforms lives.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="https://justgiving.com/educatetheorphans/donate" target="_blank" class="rounded-lg bg-white text-green-600 px-8 py-3 font-semibold hover:bg-gray-100 transition">
                    Donate Now
                </a>
                <a href="{{ route('contact') }}" class="rounded-lg border-2 border-white text-white px-8 py-3 font-semibold hover:bg-white/10 transition">
                    Get Involved
                </a>
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
                <p class="mt-3 text-gray-700 font-semibold">Children Educated & Cared For</p>
            </div>
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">7</p>
                <p class="mt-3 text-gray-700 font-semibold">Schools Operating</p>
            </div>
            <div class="rounded-2xl border bg-white p-8 text-center">
                <p class="text-5xl font-bold text-green-600">40,000+</p>
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
