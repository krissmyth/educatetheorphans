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
<section class="py-16 bg-green-50">
    <div class="mx-auto max-w-4xl px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">See Your Impact</h2>
            <p class="text-gray-600">
                Adjust the slider to see what your donation can accomplish
            </p>
        </div>

        <div class="rounded-2xl border-2 border-green-200 p-8 bg-white" x-data="donationSlider()" x-init="init()">
            {{-- Slider Control --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-gray-700">Your donation:</span>
                    <span class="text-4xl font-bold text-green-600">£<span x-text="amount"></span></span>
                </div>
                <input
                    type="range"
                    x-model.number="amount"
                    min="5"
                    max="500"
                    step="5"
                    class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-green-600"
                    @input="updateSlider()"
                >
                <div class="flex justify-between text-sm text-gray-500 mt-2">
                    <span>£5</span>
                    <span>£500+</span>
                </div>
            </div>

            {{-- Impact Display --}}
            <div class="border-t-2 border-gray-200 pt-8 mb-8">
                <div class="space-y-4">
                    <template x-for="item in impacts" :key="item.id">
                        <div class="flex items-start gap-4">
                            <div class="text-3xl flex-shrink-0" x-text="item.emoji"></div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 mb-1" x-text="item.title"></h4>
                                <p class="text-gray-700 text-sm" x-text="item.description"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- What Your Donation Buys Section --}}
            <div class="bg-green-50 rounded-lg border border-green-200 p-6 mb-8">
                <h4 class="font-bold text-gray-900 mb-4">What your donation buys:</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="item in donationBreakdown" :key="item.id">
                        <div class="text-center">
                            <div class="text-2xl mb-2" x-text="item.emoji"></div>
                            <p class="text-sm font-semibold text-gray-900" x-text="item.quantity"></p>
                            <p class="text-xs text-gray-600" x-text="item.item"></p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Summary Text --}}
            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                <p class="text-center text-gray-700">
                    <span class="font-semibold">Your £<span x-text="amount"></span> donation</span>
                    <span x-text="summaryText"></span>
                </p>
            </div>
        </div>
    </div>
</section>

<script>
function donationSlider() {
    return {
        amount: 25,
        impacts: [],
        donationBreakdown: [],
        summaryText: '',

        init() {
            this.updateSlider();
        },

        updateSlider() {
            // Update the main impact display
            let impactTexts = [];

            if (this.amount <= 10) {
                impactTexts.push({
                    title: 'School Supplies',
                    description: 'Pencils, notebooks, and basic learning materials for a child',
                    emoji: '✏️',
                    id: 1
                });
            } else if (this.amount <= 25) {
                impactTexts.push({
                    title: 'School Supplies',
                    description: 'School uniform, shoes, notebooks, and learning materials for a term',
                    emoji: '📚',
                    id: 1
                });
            } else if (this.amount <= 50) {
                impactTexts.push({
                    title: 'Food Support',
                    description: 'Monthly food provisions for a family, ensuring children stay healthy and focused on learning',
                    emoji: '🍲',
                    id: 2
                });
            } else if (this.amount <= 100) {
                impactTexts.push({
                    title: 'Education Support',
                    description: 'School fees, learning materials, and educational support for one child for a term',
                    emoji: '🎓',
                    id: 3
                });
                if (this.amount > 75) {
                    impactTexts.push({
                        title: 'Plus Food Support',
                        description: 'Nutritious meals and food support for a vulnerable family',
                        emoji: '🍲',
                        id: 4
                    });
                }
            } else if (this.amount <= 250) {
                impactTexts.push({
                    title: 'Community Project',
                    description: 'Contributes to major initiatives like clean water systems, school improvements, or healthcare',
                    emoji: '💧',
                    id: 5
                });
            } else {
                impactTexts.push({
                    title: 'Transformative Impact',
                    description: 'Provides comprehensive annual support for a child plus significant community infrastructure projects',
                    emoji: '🌟',
                    id: 6
                });
            }

            this.impacts = impactTexts;

            // Update the donation breakdown (what it buys)
            this.updateDonationBreakdown();
            this.updateSummary();
        },

        updateDonationBreakdown() {
            let items = [];

            // At £5
            if (this.amount >= 5) {
                items.push({
                    id: 1,
                    emoji: '📖',
                    quantity: '2',
                    item: 'School books'
                });
            }

            // At £10
            if (this.amount >= 10) {
                items.push({
                    id: 2,
                    emoji: '📓',
                    quantity: '5',
                    item: 'Notebooks'
                });
            }

            // At £15
            if (this.amount >= 15) {
                items.push({
                    id: 3,
                    emoji: '✏️',
                    quantity: '20',
                    item: 'Pens & pencils'
                });
            }

            // At £25
            if (this.amount >= 25) {
                items.push({
                    id: 4,
                    emoji: '👕',
                    quantity: '1',
                    item: 'School uniform'
                });
            }

            // At £35
            if (this.amount >= 35) {
                items.push({
                    id: 5,
                    emoji: '👟',
                    quantity: '1',
                    item: 'School shoes'
                });
            }

            // At £50
            if (this.amount >= 50) {
                items.push({
                    id: 6,
                    emoji: '🍎',
                    quantity: '30',
                    item: 'Days of meals'
                });
            }

            // At £75
            if (this.amount >= 75) {
                items.push({
                    id: 7,
                    emoji: '🏫',
                    quantity: '3 months',
                    item: 'School fees'
                });
            }

            // At £100
            if (this.amount >= 100) {
                items.push({
                    id: 8,
                    emoji: '💼',
                    quantity: '1',
                    item: 'School bag'
                });
            }

            // At £150
            if (this.amount >= 150) {
                items.push({
                    id: 9,
                    emoji: '💧',
                    quantity: '1',
                    item: 'Water point'
                });
            }

            // At £250
            if (this.amount >= 250) {
                items.push({
                    id: 10,
                    emoji: '🏗️',
                    quantity: 'Partial',
                    item: 'School building'
                });
            }

            // At £500
            if (this.amount >= 500) {
                items.push({
                    id: 11,
                    emoji: '👨‍👩‍👧‍👦',
                    quantity: '1 year',
                    item: 'Full support/child'
                });
            }

            this.donationBreakdown = items;
        },

        updateSummary() {
            const summaries = {
                5: 'will provide basic learning materials',
                10: 'will provide school supplies',
                25: 'will outfit a child with school essentials for a term',
                50: 'will feed a family for a month',
                75: 'will support a child\'s education for a quarter of the year',
                100: 'will provide full education support for one child for a term',
                150: 'will contribute to community infrastructure improvements',
                250: 'will fund a major community project or initiative',
                500: 'will provide year-round comprehensive support for a child plus community projects'
            };

            // Find the closest summary
            let closest = 5;
            Object.keys(summaries).forEach(key => {
                if (this.amount >= key && Math.abs(this.amount - key) < Math.abs(this.amount - closest)) {
                    closest = parseInt(key);
                }
            });

            this.summaryText = summaries[closest] || summaries[5];
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
