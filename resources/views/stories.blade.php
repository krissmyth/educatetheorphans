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
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80" alt="Livingstone Njeru" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-blue-600 mb-2">Featured Story</p>
                    <h3 class="text-lg font-bold">Livingstone Njeru: From Sponsored Child to Director</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Livingstone started as a sponsored child and rose through Educate the Orphans' programs to become our Kenya Director. His journey showcases how education and community support create leaders who give back.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"Education opened doors I never thought possible."</p>
                </div>
            </article>

            <!-- Story 2 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1579154204601-01d2cc9134c4?auto=format&fit=crop&w=600&q=80" alt="Makena N Gilugu" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-green-600 mb-2">Professional Achievement</p>
                    <h3 class="text-lg font-bold">Makena N Gilugu: Now an Accountant</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        With sponsorship from A+P McKenna, Makena received the education and support needed to pursue her dreams. Today she works as an accountant with a Kenyan bank, serving her community.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"My sponsor believed in my potential when I couldn't see it myself."</p>
                </div>
            </article>

            <!-- Story 3 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1576091160629-112173faf246?auto=format&fit=crop&w=600&q=80" alt="Muthuuri Kabea" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-purple-600 mb-2">Overcoming Adversity</p>
                    <h3 class="text-lg font-bold">Muthuuri Kabea: From Loss to Healing Professions</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Despite losing his father at a young age, Muthuuri persevered through Educate the Orphans' support. Thanks to T. Kelly's sponsorship, he became a radiographer at Chogoria Hospital, helping others heal.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"Pain became my purpose to serve others."</p>
                </div>
            </article>

            <!-- Story 4 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80" alt="Mukembi Karegi" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-orange-600 mb-2">Financial Security</p>
                    <h3 class="text-lg font-bold">Mukembi Karegi: Rising in Banking</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        With W. Taylor's sponsorship, Mukembi gained the education necessary to pursue a career in finance. He now works as a banker with one of Kenya's national banks in Nairobi.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"I'm building a secure future for my family."</p>
                </div>
            </article>

            <!-- Story 5 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80" alt="Pastor and Teacher" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-indigo-600 mb-2">Community Leaders</p>
                    <h3 class="text-lg font-bold">Sponsored Children Becoming Spiritual Leaders</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        Many former Educate the Orphans students have answered the call to ministry. They now serve as pastors, church leaders, and spiritual counselors, bringing hope and faith to their communities.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"Education gave me the tools to serve my faith and community."</p>
                </div>
            </article>

            <!-- Story 6 -->
            <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80" alt="Sponsor Reunion" class="h-48 w-full object-cover object-top">
                <div class="p-6">
                    <p class="text-sm font-semibold text-red-600 mb-2">Sponsor Impact</p>
                    <h3 class="text-lg font-bold">Living Proof: A Sponsor Meets Her Impact</h3>
                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                        When sponsors visit Kenya, they witness firsthand the transformation their investment makes. Former sponsored children, now professionals, warmly greet their sponsors—a profound moment showing education's lasting legacy.
                    </p>
                    <p class="mt-4 text-xs text-gray-500">"This is truly a miracle, all thanks to our sponsors."</p>
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
                <p class="mt-2 text-gray-700">University graduates from Educate the Orphans programs</p>
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
