@extends('layouts.public')

@section('title', 'Donate - Educate the Orphans')
@section('meta_description', 'Make a one-time or monthly donation to Educate the Orphans. 100% of your gift goes directly to feeding, clothing and educating children in Kenya. Gift Aid available.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/Donate.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="Donate"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex flex-col lg:flex-row items-end justify-between gap-8 pb-12">
            {{-- Left: Text --}}
            <div class="text-white max-w-xl">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Make a Donation</h1>
                <p class="mt-4 text-base lg:text-lg text-gray-200">Your generosity directly helps vulnerable children and families in Kenya access education, food, water, and care.</p>
                <p class="mt-3 text-sm text-gray-300">Every penny goes directly to our work. Our entire UK & Ireland team are volunteers.</p>
            </div>

            {{-- Right: JustGiving Button --}}
            <div id="jg-donate-button" class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-3 shrink-0">
                <p class="font-bold text-gray-900">Support our work in Kenya</p>
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
                <div class="mt-1 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2 text-center">
                    <p class="text-xs font-semibold text-amber-800">🇬🇧 UK taxpayer?</p>
                    <p class="text-xs text-amber-700 mt-0.5">Your donation is worth <strong>25% more</strong> at no extra cost through Gift Aid</p>
                </div>
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
        </div>
    </div>
</section>

{{-- INTERACTIVE DONATION SLIDER --}}
<section class="py-20 bg-white">
    <div class="mx-auto max-w-5xl px-4" x-data="donationSlider()" x-init="init()">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-3">See Your Impact</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Adjust the slider to see exactly what your donation can accomplish for vulnerable children and families
            </p>
        </div>

        {{-- Frequency Toggle --}}
        <div class="flex justify-center mb-8">
            <div class="inline-flex rounded-full border-2 border-gray-300 bg-gray-50 p-1">
                <button
                    type="button"
                    @click="frequency = 'monthly'; updateSlider()"
                    :class="frequency === 'monthly' ? 'bg-green-600 text-white' : 'text-gray-700'"
                    class="px-8 py-3 rounded-full font-semibold transition-all duration-200"
                >
                    Monthly Donation
                </button>
                <button
                    type="button"
                    @click="frequency = 'one-off'; updateSlider()"
                    :class="frequency === 'one-off' ? 'bg-green-600 text-white' : 'text-gray-700'"
                    class="px-8 py-3 rounded-full font-semibold transition-all duration-200"
                >
                    One-off Donation
                </button>
            </div>
        </div>

        {{-- Main Slider Section --}}
        <div class="bg-gradient-to-b from-green-50 to-white rounded-3xl border-2 border-green-100 p-8 mb-8">
            {{-- Slider and Amount Display --}}
            <div class="flex items-end gap-6 mb-6">
                {{-- Slider --}}
                <div class="flex-1">
                    <div class="mb-3">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Your donation</p>
                    </div>
                    <input
                        type="range"
                        x-model.number="amount"
                        :min="5"
                        :max="frequency === 'monthly' ? 100 : 500"
                        :step="5"
                        class="w-full h-4 bg-gradient-to-r from-green-200 to-green-400 rounded-full appearance-none cursor-pointer accent-green-600"
                        @input="updateSlider()"
                        style="min-height: 24px;"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-2 font-semibold">
                        <span>£5</span>
                        <span x-text="frequency === 'monthly' ? '£100+' : '£500+'"></span>
                    </div>
                </div>

                {{-- Amount Display --}}
                <div class="text-right">
                    <div class="text-6xl font-bold text-amber-500 leading-none mb-1">
                        £<span x-text="amount"></span>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold">
                        <span x-text="frequency === 'monthly' ? 'per month' : 'one-time'"></span>
                    </p>
                </div>
            </div>

            {{-- What Your Donation Buys Section --}}
            <div class="pt-6 border-t-2 border-green-200">
                <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-4">What your donation could provide:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <template x-for="item in donationBreakdown" :key="item.id">
                        <div class="text-center p-3 rounded-xl bg-white border border-green-100 hover:shadow-lg transition">
                            <div class="text-4xl mb-2" x-text="item.emoji"></div>
                            <p class="font-bold text-base text-gray-900 mb-1" x-text="item.quantity"></p>
                            <p class="text-xs text-gray-700 leading-tight" x-text="item.item"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Impact Statement --}}
        <div class="text-center bg-green-50 rounded-2xl p-6 border border-green-200 mb-8">
            <p class="text-base text-gray-700">
                <span class="font-bold text-green-700" x-text="'£' + amount + ' ' + (frequency === 'monthly' ? 'every month' : 'today')"></span>
                <span x-text="summaryText" class="text-gray-700"></span>
            </p>
        </div>

        {{-- Donate Button --}}
        <div class="text-center flex flex-col items-center gap-2">
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
        </div>


    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-16 bg-gray-50" id="donation-form">
    <div class="mx-auto max-w-4xl px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Why Give Online?</h2>
        
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="text-5xl mb-4">🛡️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Charity Verified</h3>
                <p class="text-gray-600">
                    We're a registered and audited charity committed to transparency and accountability.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="text-5xl mb-4">💳</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Secure Payments</h3>
                <p class="text-gray-600">
                    All payments are processed securely through JustGiving.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="text-5xl mb-4">📈</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Gift Aid Boost</h3>
                <p class="text-gray-600">
                    UK taxpayers can add 25% to their donation at no extra cost through Gift Aid.
                </p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-green-50 rounded-2xl p-8 border-2 border-green-200">
                <h4 class="font-bold text-gray-900 mb-4 text-xl">Flexible Giving Options</h4>
                <div class="space-y-3 text-gray-700">
                    <div class="flex gap-4">
                        <span class="text-green-600 font-bold">📅</span>
                        <div>
                            <p class="font-semibold text-gray-900">Monthly Giving</p>
                            <p class="text-sm">Sustain our programmes year-round</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="text-green-600 font-bold">💚</span>
                        <div>
                            <p class="font-semibold text-gray-900">One-Off Donation</p>
                            <p class="text-sm">Make an immediate difference</p>
                        </div>
                    </div>
                    <p class="text-sm pt-3 border-t border-green-300">
                        Both options reach children in need quickly. Your support creates lasting change.
                    </p>
                </div>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 border-2 border-blue-200">
                <h4 class="font-bold text-gray-900 mb-4 text-xl">100% Goes to Our Work</h4>
                <p class="text-gray-700 mb-4">
                    Every penny we receive goes directly to supporting vulnerable children and families. 
                    Our entire UK & Ireland team are volunteers, ensuring that all donations support those most in need.
                </p>
                <a href="/about" 
                   class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    Learn More About Us
                </a>
            </div>
        </div>
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
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can I give regularly?</h3>
                <p class="text-gray-700">
                    Through JustGiving, you can set up a monthly donation to provide ongoing support. Regular donors make a tremendous difference in our ability to plan and expand our programmes.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How is my money used?</h3>
                <p class="text-gray-700">
                    100% of donations go directly to our programmes in Kenya. Our entire UK & Ireland team are volunteers, so your money goes where it matters most. Our accounts are filed with the Charity Commission for Northern Ireland and are available to view there.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Can I donate in another way?</h3>
                <p class="text-gray-700">
                    Yes! You can contact us directly at <a href="mailto:info@educatetheorphans.com" class="text-green-600 font-semibold hover:underline">info@educatetheorphans.com</a> to discuss other giving options.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
function donationSlider() {
    return {
        amount: 50,
        frequency: 'monthly',
        donationBreakdown: [],
        summaryText: '',

        init() {
            this.updateSlider();
        },

        updateSlider() {
            this.updateDonationBreakdown();
            this.updateSummary();
        },

        updateDonationBreakdown() {
            let items = [];

            if (this.frequency === 'monthly') {
                // Monthly donation breakdown based on real costs
                // £20/month = school fees for 1 child
                items = [
                    {
                        id: 1,
                        emoji: '🎓',
                        quantity: Math.max(1, Math.floor(this.amount / 20)),
                        item: this.amount >= 20 ? (Math.floor(this.amount / 20) === 1 ? 'child\'s school fees paid' : 'children\'s school fees paid') : 'contribution toward a child\'s school fees'
                    },
                    {
                        id: 2,
                        emoji: '📚',
                        quantity: Math.max(1, Math.floor(this.amount / 5)),
                        item: 'School books'
                    },
                    {
                        id: 3,
                        emoji: '✏️',
                        quantity: Math.max(5, Math.floor(this.amount / 5) * 5),
                        item: 'Writing materials'
                    },
                    {
                        id: 4,
                        emoji: '🍎',
                        quantity: Math.max(2, Math.floor(this.amount / 5) * 2),
                        item: 'Meals provided'
                    }
                ];
            } else {
                // One-off donation breakdown based on real costs
                // £30 = school uniform for 1 child
                if (this.amount >= 5) {
                    items.push({
                        id: 1,
                        emoji: '📚',
                        quantity: Math.floor(this.amount / 5),
                        item: Math.floor(this.amount / 5) === 1 ? 'School book' : 'School books'
                    });
                }

                if (this.amount >= 5) {
                    items.push({
                        id: 2,
                        emoji: '✏️',
                        quantity: Math.floor(this.amount / 5) * 5,
                        item: 'Writing materials'
                    });
                }

                if (this.amount >= 5) {
                    items.push({
                        id: 4,
                        emoji: '🍎',
                        quantity: Math.floor(this.amount / 5) * 2,
                        item: 'Meals'
                    });
                }

                if (this.amount >= 20) {
                    items.push({
                        id: 5,
                        emoji: '🎓',
                        quantity: Math.floor(this.amount / 20),
                        item: Math.floor(this.amount / 20) === 1 ? 'child\'s school fees for 1 month' : 'children\'s school fees for 1 month'
                    });
                }

                if (this.amount >= 30) {
                    items.push({
                        id: 6,
                        emoji: '👕',
                        quantity: Math.floor(this.amount / 30),
                        item: Math.floor(this.amount / 30) === 1 ? 'school uniform' : 'school uniforms'
                    });
                }

                // Pad to 4 items for small amounts
                while (items.length < 4 && this.amount >= 5) {
                    if (items.length === 1) {
                        items.push({ id: 2, emoji: '📓', quantity: Math.floor(this.amount / 3), item: 'Notebooks' });
                    } else if (items.length === 2) {
                        items.push({ id: 3, emoji: '🍎', quantity: Math.floor(this.amount / 2), item: 'Days of meals' });
                    } else {
                        items.push({ id: 4, emoji: '💧', quantity: 1, item: 'Contribution toward clean water' });
                    }
                }
            }

            // Keep only the first 4 items
            this.donationBreakdown = items.slice(0, 4);
        },

        updateSummary() {
            if (this.frequency === 'monthly') {
                const monthlySummaries = {
                    5: 'will provide school books and writing materials for a child',
                    10: 'will contribute toward a child\'s school fees each month',
                    20: 'will pay school fees for one child every month',
                    40: 'will pay school fees for two children every month',
                    60: 'will pay school fees for three children every month',
                    100: 'will pay school fees for five children every month'
                };

                let closest = 2;
                Object.keys(monthlySummaries).forEach(key => {
                    if (this.amount >= key && Math.abs(this.amount - key) < Math.abs(this.amount - closest)) {
                        closest = parseInt(key);
                    }
                });

                this.summaryText = ' ' + (monthlySummaries[closest] || monthlySummaries[2]);
            } else {
                const oneOffSummaries = {
                    5: 'will provide school books for a child',
                    10: 'will feed a child for one week',
                    20: 'will feed a child for two weeks',
                    30: 'will buy a school uniform for one child',
                    60: 'will buy school uniforms for two children',
                    90: 'will buy school uniforms for three children',
                    100: 'will buy school uniforms and cover school fees for a month',
                    200: 'will make a lasting difference to multiple children\'s education',
                    500: 'will transform the lives of many children in Kenya'
                };

                let closest = 5;
                Object.keys(oneOffSummaries).forEach(key => {
                    if (this.amount >= key && Math.abs(this.amount - key) < Math.abs(this.amount - closest)) {
                        closest = parseInt(key);
                    }
                });

                this.summaryText = ' ' + (oneOffSummaries[closest] || oneOffSummaries[5]);
            }
        }
    }
}
</script>

@endsection
