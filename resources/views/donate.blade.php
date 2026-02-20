@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1532996122724-8f6ba07a18e3?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="Donate"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Make a Donation</h1>
                <p class="mt-5 text-lg text-gray-200">Your generosity directly helps vulnerable children and families in Kenya access education, food, water, and care.</p>
            </div>
        </div>
    </div>
</section>

{{-- DONATION IMPACT SECTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl font-bold mb-4">See Your Impact</h2>
            <p class="text-gray-600">
                Every pounds you donate makes a real difference. Here's how your support can help the children and families we serve.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- £25 --}}
            <div class="rounded-2xl border-2 border-green-200 p-8 bg-white hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-4xl font-bold text-green-600">£25</p>
                    </div>
                    <div class="text-4xl">📚</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">School Supplies</h3>
                <p class="text-gray-700 mb-4">
                    Provides school uniforms, notebooks, pens, and learning materials for a child for an entire term.
                </p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>School uniform and shoes</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Notebooks and stationery</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>School bag and learning materials</span>
                    </li>
                </ul>
            </div>

            {{-- £50 --}}
            <div class="rounded-2xl border-2 border-green-200 p-8 bg-white hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-4xl font-bold text-green-600">£50</p>
                    </div>
                    <div class="text-4xl">🍲</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Food Support</h3>
                <p class="text-gray-700 mb-4">
                    Provides nutritious meals and food support for a family for a month, helping children stay healthy and focused on learning.
                </p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Monthly food provisions for a family</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>School meals for several weeks</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Nutritional support for children</span>
                    </li>
                </ul>
            </div>

            {{-- £100 --}}
            <div class="rounded-2xl border-2 border-green-200 p-8 bg-white hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-4xl font-bold text-green-600">£100</p>
                    </div>
                    <div class="text-4xl">🎓</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Education Support</h3>
                <p class="text-gray-700 mb-4">
                    Provides comprehensive education support for a student including school fees, tutoring, and learning materials for a term.
                </p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>School fees for a term</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Educational materials and books</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Exam preparation and tutoring support</span>
                    </li>
                </ul>
            </div>

            {{-- £250 --}}
            <div class="rounded-2xl border-2 border-green-200 p-8 bg-white hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-4xl font-bold text-green-600">£250</p>
                    </div>
                    <div class="text-4xl">💧</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Community Project</h3>
                <p class="text-gray-700 mb-4">
                    Supports a major community initiative such as water systems, school improvements, healthcare access, or skills training programmes.
                </p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Contributes to clean water projects</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>School facility improvements</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-600 mr-2 font-bold">•</span>
                        <span>Healthcare and skills training initiatives</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-3xl px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Make a Difference?</h2>
        <p class="text-gray-600 mb-8">
            Donate any amount you choose. All donations go directly to programmes and services. We're committed to transparency—you can see exactly how your gift is used.
        </p>

        <a href="https://www.justgiving.com/educatetheorphans/donate"
           target="_blank" rel="noopener"
           class="inline-flex items-center justify-center rounded-lg bg-green-600 text-white px-8 py-4 font-semibold hover:bg-green-700 transition text-lg">
            Donate Now
        </a>

        <p class="mt-6 text-sm text-gray-500">
            You'll be taken to our secure JustGiving page to complete your donation.<br>
            <span class="font-semibold">100% of donations go directly to programmes and services.</span>
        </p>
    </div>
</section>

{{-- FAQ SECTION --}}
<section class="py-16">
    <div class="mx-auto max-w-3xl px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Donation Questions</h2>

        <div class="space-y-6">
            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Is my donation secure?</h3>
                <p class="text-gray-700">
                    Yes! All donations are processed securely through JustGiving, a trusted charitable giving platform used by millions of donors worldwide.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Is my donation tax-deductible?</h3>
                <p class="text-gray-700">
                    Yes! Educate the Orphans is a registered nonprofit organisation. You will receive a tax receipt for your donation, making it eligible for tax deductions where applicable.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can I give regularly?</h3>
                <p class="text-gray-700">
                    Through JustGiving, you can set up a monthly donation to provide ongoing support. Regular donors make a tremendous difference in our ability to plan and expand our programmes.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How is my money used?</h3>
                <p class="text-gray-700">
                    We maintain full transparency about how donations are used. Visit our About page to see our financial reports and impact statistics. Most donations go directly to programmes—we keep administrative costs minimal.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Can I donate in another way?</h3>
                <p class="text-gray-700">
                    Yes! You can contact us directly at <a href="mailto:info@educatetheorphans.org" class="text-green-600 font-semibold hover:underline">info@educatetheorphans.org</a> to discuss other giving options such as bank transfers, corporate donations, or grants.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
