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
        <div class="flex justify-center mb-12">
            <div class="inline-flex rounded-full border-2 border-gray-300 bg-gray-50 p-1">
                <button
                    @click="frequency = 'one-off'; updateSlider()"
                    :class="frequency === 'one-off' ? 'bg-green-600 text-white' : 'text-gray-700'"
                    class="px-8 py-3 rounded-full font-semibold transition-all duration-200"
                >
                    One-off Donation
                </button>
                <button
                    @click="frequency = 'monthly'; updateSlider()"
                    :class="frequency === 'monthly' ? 'bg-green-600 text-white' : 'text-gray-700'"
                    class="px-8 py-3 rounded-full font-semibold transition-all duration-200"
                >
                    Monthly Donation
                </button>
            </div>
        </div>

        {{-- Main Slider Section --}}
        <div class="bg-gradient-to-b from-green-50 to-white rounded-3xl border-2 border-green-100 p-12 mb-12">
            {{-- Slider and Amount Display --}}
            <div class="flex items-end gap-8 mb-8">
                {{-- Slider --}}
                <div class="flex-1">
                    <div class="mb-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Your donation</p>
                    </div>
                    <input
                        type="range"
                        x-model.number="amount"
                        :min="frequency === 'monthly' ? 2 : 5"
                        :max="frequency === 'monthly' ? 100 : 500"
                        :step="frequency === 'monthly' ? 1 : 5"
                        class="w-full h-4 bg-gradient-to-r from-green-200 to-green-400 rounded-full appearance-none cursor-pointer accent-green-600"
                        @input="updateSlider()"
                        style="min-height: 24px;"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-3 font-semibold">
                        <span x-text="frequency === 'monthly' ? '£2' : '£5'"></span>
                        <span x-text="frequency === 'monthly' ? '£100+' : '£500+'"></span>
                    </div>
                </div>

                {{-- Amount Display --}}
                <div class="text-right">
                    <div class="text-7xl font-bold text-green-600 leading-none mb-2">
                        £<span x-text="amount"></span>
                    </div>
                    <p class="text-sm text-gray-600 font-semibold">
                        <span x-text="frequency === 'monthly' ? 'per month' : 'one-time'"></span>
                    </p>
                </div>
            </div>

            {{-- What Your Donation Buys Section --}}
            <div class="pt-10 border-t-2 border-green-200">
                <p class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-8">What your donation could provide:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <template x-for="item in donationBreakdown" :key="item.id">
                        <div class="text-center p-4 rounded-xl bg-white border border-green-100 hover:shadow-lg transition">
                            <div class="text-5xl mb-3" x-text="item.emoji"></div>
                            <p class="font-bold text-lg text-gray-900 mb-2" x-text="item.quantity"></p>
                            <p class="text-sm text-gray-700 leading-tight" x-text="item.item"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Impact Statement --}}
        <div class="text-center bg-green-50 rounded-2xl p-8 border border-green-200 mb-12">
            <p class="text-lg text-gray-700">
                <span class="font-bold text-green-700" x-text="'£' + amount + ' ' + (frequency === 'monthly' ? 'every month' : 'today')"></span>
                <span x-text="summaryText" class="text-gray-700"></span>
            </p>
        </div>
    </div>
</section>

<script>
function donationSlider() {
    return {
        amount: 15,
        frequency: 'one-off',
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
                // Monthly donation breakdown - showing 4 items
                items = [
                    {
                        id: 1,
                        emoji: '📚',
                        quantity: Math.max(1, Math.floor(this.amount / 2)),
                        item: 'School books per child'
                    },
                    {
                        id: 2,
                        emoji: '🍎',
                        quantity: Math.max(7, Math.floor(this.amount * 3)),
                        item: 'Meals provided'
                    },
                    {
                        id: 3,
                        emoji: '✏️',
                        quantity: Math.max(5, Math.floor(this.amount * 2)),
                        item: 'Writing materials'
                    },
                    {
                        id: 4,
                        emoji: '🎓',
                        quantity: Math.ceil(this.amount / 10),
                        item: 'Children supported'
                    }
                ];
            } else {
                // One-off donation breakdown - showing 4 items
                if (this.amount >= 5) {
                    items.push({
                        id: 1,
                        emoji: '📚',
                        quantity: Math.floor(this.amount / 5 * 2),
                        item: 'School books'
                    });
                }

                if (this.amount >= 10) {
                    items.push({
                        id: 2,
                        emoji: '✏️',
                        quantity: Math.floor(this.amount / 2.5),
                        item: 'Pens & pencils'
                    });
                }

                if (this.amount >= 15) {
                    items.push({
                        id: 3,
                        emoji: '🍎',
                        quantity: Math.floor(this.amount / 2),
                        item: 'Days of meals'
                    });
                }

                if (this.amount >= 25) {
                    items.push({
                        id: 4,
                        emoji: '👕',
                        quantity: Math.floor(this.amount / 25),
                        item: 'School uniforms'
                    });
                }

                // Ensure we always show 4 items minimum
                while (items.length < 4 && this.amount >= 5) {
                    if (items.length === 0) {
                        items.push({
                            id: 1,
                            emoji: '✏️',
                            quantity: '20',
                            item: 'Pens & pencils'
                        });
                    } else if (items.length === 1) {
                        items.push({
                            id: 2,
                            emoji: '📓',
                            quantity: '5',
                            item: 'Notebooks'
                        });
                    } else if (items.length === 2) {
                        items.push({
                            id: 3,
                            emoji: '🍎',
                            quantity: '10',
                            item: 'Days of meals'
                        });
                    } else {
                        items.push({
                            id: 4,
                            emoji: '💧',
                            quantity: '1',
                            item: 'Water point (partial)'
                        });
                    }
                }
            }

            // Keep only the first 4 items
            this.donationBreakdown = items.slice(0, 4);
        },

        updateSummary() {
            if (this.frequency === 'monthly') {
                const monthlySummaries = {
                    2: 'will provide essential school supplies for children',
                    5: 'will support basic education and nutrition',
                    10: 'will fully support one child\'s education',
                    20: 'will support multiple children and fund community projects',
                    50: 'will provide comprehensive support for a family and school improvements',
                    100: 'will create transformative impact with sustained programmes'
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
                    5: 'will provide school supplies for a child',
                    10: 'will provide essential school materials',
                    25: 'will outfit a child with uniforms and materials',
                    50: 'will provide a month of food support for a family',
                    100: 'will support one child\'s education for a term',
                    250: 'will fund important community infrastructure',
                    500: 'will create sustainable long-term community impact'
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
