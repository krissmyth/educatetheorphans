@extends('layouts.public')

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')

{{-- HERO WITH DONATION WIDGET --}}
<section class="relative">
    <img
        src="{{ asset('images/Donate.jpg') }}"
        class="h-[900px] lg:h-[700px] w-full object-cover"
        alt="Donate"
    >
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex flex-col lg:flex-row items-center justify-between gap-8 py-12">
            {{-- Left side - Text Content --}}
            <div class="max-w-xl text-white text-center lg:text-left">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Make a Donation</h1>
                <p class="mt-5 text-base lg:text-lg text-gray-200">Your generosity directly helps vulnerable children and families in Kenya access education, food, water, and care.</p>
            </div>

            {{-- Right side - Donation Widget --}}
            <div class="w-full max-w-md" x-data="donationWidget()" x-init="init()">
                <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-gray-900 text-white text-center py-4 px-6">
                        <h2 class="text-xl font-bold uppercase tracking-wide">Donate to Educate the Orphans</h2>
                    </div>

                    {{-- Widget Content --}}
                    <div class="p-6">
                        {{-- Frequency Toggle --}}
                        <div class="grid grid-cols-2 gap-0 mb-6 border-2 border-gray-300 rounded overflow-hidden">
                            <button
                                type="button"
                                @click="frequency = 'single'"
                                :class="frequency === 'single' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                                class="py-3 px-6 font-bold text-sm uppercase border-r-2 border-gray-300 transition-colors"
                            >
                                Single
                            </button>
                            <button
                                type="button"
                                @click="frequency = 'monthly'"
                                :class="frequency === 'monthly' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600'"
                                class="py-3 px-6 font-bold text-sm uppercase transition-colors"
                            >
                                Monthly
                            </button>
                        </div>

                        {{-- Preset Amounts --}}
                        <div class="grid grid-cols-3 gap-0 mb-4 border-2 border-gray-300 rounded overflow-hidden">
                            <button
                                type="button"
                                @click="amount = 10"
                                :class="amount === 10 ? 'bg-green-600 text-white' : 'bg-white text-gray-900'"
                                class="py-3 px-4 font-bold text-base border-r-2 border-gray-300 transition-colors"
                            >
                                £10
                            </button>
                            <button
                                type="button"
                                @click="amount = 20"
                                :class="amount === 20 ? 'bg-green-600 text-white' : 'bg-white text-gray-900'"
                                class="py-3 px-4 font-bold text-base border-r-2 border-gray-300 transition-colors"
                            >
                                £20
                            </button>
                            <button
                                type="button"
                                @click="amount = 50"
                                :class="amount === 50 ? 'bg-green-600 text-white' : 'bg-white text-gray-900'"
                                class="py-3 px-4 font-bold text-base transition-colors"
                            >
                                £50
                            </button>
                        </div>

                        {{-- Impact Text --}}
                        <div class="mb-6 text-center min-h-[48px]">
                            <p class="text-sm text-gray-700 leading-snug" x-text="impactText"></p>
                        </div>

                        {{-- Custom Amount Input --}}
                        <div class="mb-6">
                            <div class="flex items-center border-2 border-gray-300 rounded">
                                <span class="pl-4 pr-2 text-gray-700 font-bold text-lg">£</span>
                                <input
                                    type="number"
                                    x-model.number="amount"
                                    min="5"
                                    step="5"
                                    placeholder="Or enter other amount"
                                    class="flex-1 py-3 px-2 text-gray-700 placeholder-gray-400 text-base border-0 focus:outline-none focus:ring-0"
                                >
                            </div>
                        </div>

                        {{-- Donate Button --}}
                        <button
                            type="button"
                            @click="showPaymentModal = true"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded transition-colors text-lg uppercase tracking-wide"
                        >
                            🤝 Donate Now
                        </button>

                        {{-- Payment Methods --}}
                        <div class="mt-4 flex items-center justify-center gap-4 opacity-60">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/200px-Visa_Inc._logo.svg.png" alt="Visa" class="h-5 grayscale">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/200px-Mastercard-logo.svg.png" alt="Mastercard" class="h-5 grayscale">
                        </div>
                    </div>
                </div>

                {{-- Payment Modal --}}
                <div 
                    x-show="showPaymentModal" 
                    x-cloak
                    @click.self="showPaymentModal = false"
                    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4"
                    style="display: none;"
                >
                    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                        {{-- Modal Header --}}
                        <div class="bg-green-600 text-white p-6 flex justify-between items-center sticky top-0">
                            <div>
                                <h3 class="text-xl font-bold">
                                    <span x-text="frequency === 'monthly' ? 'Monthly' : 'Single'"></span> Donation
                                </h3>
                                <p class="text-sm opacity-90 mt-1">
                                    You are donating £<span x-text="amount"></span>
                                </p>
                            </div>
                            <button 
                                @click="showPaymentModal = false"
                                class="text-white hover:bg-green-700 rounded-full w-8 h-8 flex items-center justify-center"
                            >
                                ✕
                            </button>
                        </div>

                        {{-- Modal Content --}}
                        <div class="p-6 space-y-5">
                            {{-- Success Message --}}
                            <div x-show="success" x-transition class="bg-green-100 border-2 border-green-500 text-green-800 rounded-lg p-4">
                                <div class="font-bold mb-1">✓ Thank you for your donation!</div>
                                <div class="text-sm">Your payment has been processed successfully.</div>
                            </div>

                            <div x-show="!success">
                                {{-- Gift Aid Checkbox --}}
                                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                                    <label class="flex items-start gap-3 cursor-pointer">
                                        <input
                                            type="checkbox"
                                            x-model="giftAidEnabled"
                                            class="mt-1 h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                        >
                                        <div class="flex-1">
                                            <div class="font-bold text-gray-900 mb-1">
                                                Boost your donation by <span x-text="'£' + (amount * 0.25).toFixed(2)"></span> at no extra cost to you with Gift Aid *
                                            </div>
                                            <div class="text-xs text-gray-600 leading-relaxed">
                                                * YES, I want to Gift Aid this donation and any future donations I make or have made in the past four years to Educate the Orphans. I am a UK taxpayer and understand that if I pay less Income Tax and/or Capital Gains Tax in that tax year than the amount of Gift Aid claimed on all my donations it is my responsibility to pay any difference.
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                {{-- Donor Email --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                                    <input
                                        type="email"
                                        x-model="donorEmail"
                                        required
                                        placeholder="your@email.com"
                                        class="w-full py-3 px-4 border-2 border-gray-300 rounded focus:outline-none focus:border-green-500"
                                    >
                                    <p class="text-xs text-gray-500 mt-1">We'll send your receipt to this email</p>
                                </div>

                                {{-- Gift Aid Details (conditional) --}}
                                <div x-show="giftAidEnabled" x-transition class="space-y-4">
                                    <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                                        <h4 class="font-bold text-gray-900 mb-3">Gift Aid Details</h4>
                                        <p class="text-xs text-gray-600 mb-4">Please provide your details for Gift Aid</p>
                                        
                                        <div class="space-y-3">
                                            <div class="grid grid-cols-3 gap-2">
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Title *</label>
                                                    <select x-model="giftAid.title" required maxlength="4" class="w-full py-2 px-2 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                                        <option value="">Select</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Dr">Dr</option>
                                                    </select>
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">First Name or Initial *</label>
                                                    <input type="text" x-model="giftAid.firstName" required maxlength="35" placeholder="No spaces in first name" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-700 mb-1">Last Name *</label>
                                                <input type="text" x-model="giftAid.lastName" required maxlength="35" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-700 mb-1">House Name or Number *</label>
                                                <input type="text" x-model="giftAid.addressLine1" required maxlength="40" placeholder="House name or number" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-700 mb-1">Street Name</label>
                                                <input type="text" x-model="giftAid.addressLine2" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">City *</label>
                                                    <input type="text" x-model="giftAid.city" required class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Postcode * (e.g. SW1A 1AA)</label>
                                                    <input type="text" x-model="giftAid.postcode" @input="giftAid.postcode = giftAid.postcode.toUpperCase()" required maxlength="10" placeholder="SW1A 1AA" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500 uppercase">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-700 mb-1">Aggregated Donations Description</label>
                                                <input type="text" x-model="giftAid.aggregatedDonations" maxlength="35" placeholder="e.g. Monthly donations 2025 (optional)" class="w-full py-2 px-3 text-sm border-2 border-gray-300 rounded focus:outline-none focus:border-green-500">
                                                <p class="text-xs text-gray-500 mt-1">Optional: Brief description, max 35 characters</p>
                                            </div>
                                            <div>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="checkbox" x-model="giftAid.sponsoredEvent" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                                    <span class="text-xs font-semibold text-gray-700">This is a sponsored event donation</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card Details --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Card Details *</label>
                                    <div id="card-element" class="py-3 px-4 border-2 border-gray-300 rounded"></div>
                                    <div id="card-errors" class="text-red-600 text-sm mt-2" x-text="cardError"></div>
                                </div>

                                {{-- Process Payment Button --}}
                                <button
                                    type="button"
                                    @click="processPayment()"
                                    :disabled="processing"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded transition-colors text-lg uppercase tracking-wide disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span x-show="!processing">Complete Donation</span>
                                    <span x-show="processing">Processing...</span>
                                </button>

                                <p class="text-xs text-gray-500 text-center">
                                    🔒 Your payment is secure and encrypted
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


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
                    <div class="text-6xl font-bold text-green-600 leading-none mb-1">
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
        <div class="text-center">
            <a
                href="#donation-form"
                class="inline-flex items-center justify-center rounded-lg bg-green-600 text-white px-16 py-5 font-bold hover:bg-green-700 transition text-xl"
            >
                🤝 Donate Now
            </a>
            <p class="text-sm text-gray-500 mt-3">
                Secure payment processed by Stripe
            </p>
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
                    All payments are processed securely through Stripe with bank-level encryption.
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
                    All our UK staff are volunteers, ensuring that all donations support those most in need.
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

<script>
// Initialize Stripe
const stripe = Stripe('{{ $stripeKey }}');
const elements = stripe.elements();
let cardElement;

function donationWidget() {
    return {
        amount: 10,
        frequency: 'monthly',
        impactText: '',
        donorEmail: '',
        giftAidEnabled: false,
        giftAid: {
            title: '',
            firstName: '',
            lastName: '',
            addressLine1: '',
            addressLine2: '',
            city: '',
            postcode: '',
            aggregatedDonations: '',
            sponsoredEvent: false
        },
        processing: false,
        success: false,
        cardError: '',
        showPaymentModal: false,

        init() {
            this.updateImpact();
            this.$watch('amount', () => this.updateImpact());
            this.$watch('frequency', () => this.updateImpact());
            
            // Initialize Stripe Card Element when modal is shown
            this.$watch('showPaymentModal', (value) => {
                if (value === true) {
                    this.$nextTick(() => {
                        if (!cardElement) {
                            cardElement = elements.create('card', {
                                style: {
                                    base: {
                                        fontSize: '16px',
                                        color: '#374151',
                                        '::placeholder': {
                                            color: '#9CA3AF',
                                        },
                                    },
                                },
                            });
                            cardElement.mount('#card-element');
                            
                            cardElement.on('change', (event) => {
                                if (event.error) {
                                    this.cardError = event.error.message;
                                } else {
                                    this.cardError = '';
                                }
                            });
                        }
                    });
                }
            });
        },

        updateImpact() {
            if (this.frequency === 'monthly') {
                if (this.amount >= 15) {
                    this.impactText = `Your donation could supply ${Math.floor(this.amount * 2.5)} sachets of food paste to malnourished children each month`;
                } else if (this.amount >= 10) {
                    this.impactText = `Your donation could provide educational supplies for ${Math.floor(this.amount / 5)} children each month`;
                } else {
                    this.impactText = `Your donation could help provide meals for children in need each month`;
                }
            } else {
                if (this.amount >= 50) {
                    this.impactText = `Your donation could provide a month of food support for a family`;
                } else if (this.amount >= 25) {
                    this.impactText = `Your donation could outfit a child with uniform and school materials`;
                } else if (this.amount >= 15) {
                    this.impactText = `Your donation could provide essential school supplies for a child`;
                } else {
                    this.impactText = `Your donation could help provide school books and materials`;
                }
            }
        },

        async processPayment() {
            // Validation
            if (!this.donorEmail || this.amount < 5) {
                alert('Please enter your email and a donation amount of at least £5');
                return;
            }

            if (this.giftAidEnabled) {
                if (!this.giftAid.title || !this.giftAid.firstName || !this.giftAid.lastName || 
                    !this.giftAid.addressLine1 || !this.giftAid.city || !this.giftAid.postcode) {
                    alert('Please complete all Gift Aid fields');
                    return;
                }
            }

            this.processing = true;
            this.cardError = '';

            try {
                // Create Payment Intent
                const response = await fetch('/stripe/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        amount: this.amount,
                        frequency: this.frequency === 'monthly' ? 'monthly' : 'one-time',
                        payment_method: 'card',
                        donor_email: this.donorEmail,
                        gift_aid: this.giftAidEnabled,
                        gift_aid_title: this.giftAidEnabled ? this.giftAid.title : null,
                        gift_aid_first_name: this.giftAidEnabled ? this.giftAid.firstName : null,
                        gift_aid_last_name: this.giftAidEnabled ? this.giftAid.lastName : null,
                        gift_aid_address_line1: this.giftAidEnabled ? this.giftAid.addressLine1 : null,
                        gift_aid_address_line2: this.giftAidEnabled ? this.giftAid.addressLine2 : null,
                        gift_aid_city: this.giftAidEnabled ? this.giftAid.city : null,
                        gift_aid_postcode: this.giftAidEnabled ? this.giftAid.postcode : null,
                        aggregated_donations: this.giftAidEnabled ? this.giftAid.aggregatedDonations : null,
                        sponsored_event: this.giftAidEnabled ? this.giftAid.sponsoredEvent : false
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.error || 'Payment failed');
                }

                // Confirm the payment with Stripe
                const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            email: this.donorEmail,
                        },
                    },
                });

                if (error) {
                    this.cardError = error.message;
                    this.processing = false;
                } else if (paymentIntent.status === 'succeeded') {
                    // Payment succeeded
                    await fetch('/stripe/payment-success', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            payment_intent_id: paymentIntent.id
                        })
                    });

                    this.success = true;
                    this.processing = false;
                    this.resetForm();
                }
            } catch (error) {
                this.cardError = error.message;
                this.processing = false;
            }
        },

        resetForm() {
            this.donorEmail = '';
            this.giftAid = {
                title: '',
                firstName: '',
                lastName: '',
                addressLine1: '',
                addressLine2: '',
                city: '',
                postcode: '',
                aggregatedDonations: '',
                sponsoredEvent: false
            };
            this.cardError = '';
            if (cardElement) {
                cardElement.clear();
            }
            
            // Close modal after a delay to show success message
            setTimeout(() => {
                this.success = false;
                this.showPaymentModal = false;
            }, 2000);
        }
    }
}

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

@endsection
