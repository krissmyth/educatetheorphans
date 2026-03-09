@extends('layouts.public')

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ $paypalClientId }}&currency=GBP&intent=capture"></script>
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
                        <div class="mt-4 flex items-center justify-center gap-6 opacity-90">
                            <img src="{{ asset('images/visa-logo.svg') }}" alt="Visa" class="h-7 object-contain">
                            <img src="{{ asset('images/mastercard-logo.svg') }}" alt="Mastercard" class="h-7 object-contain">
                            <img src="{{ asset('images/paypal-logo.svg') }}" alt="PayPal" class="h-7 object-contain">
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
                                {{-- Payment Gateway Selector --}}
                                <div class="grid grid-cols-2 gap-0 mb-6 border-2 border-gray-300 rounded overflow-hidden">
                                    <button
                                        type="button"
                                        @click="paymentGateway = 'stripe'"
                                        :class="paymentGateway === 'stripe' ? 'bg-blue-600 text-white border-blue-600' : 'bg-gray-100 text-gray-700 border-gray-300'"
                                        class="py-3 px-4 font-semibold text-sm flex items-center justify-center gap-2 border-r-2 transition-colors"
                                    >
                                        <svg class="h-5 w-auto" viewBox="0 0 60 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M59.64 14.28h-8.06c.19 1.93 1.6 2.55 3.2 2.55 1.64 0 2.96-.37 4.05-.95v3.32a8.33 8.33 0 0 1-4.56 1.1c-4.01 0-6.83-2.5-6.83-7.48 0-4.19 2.39-7.52 6.3-7.52 3.92 0 5.96 3.28 5.96 7.5 0 .4-.04 1.26-.06 1.48zm-5.92-5.62c-1.03 0-2.17.73-2.17 2.58h4.25c0-1.85-1.07-2.58-2.08-2.58zM40.95 20.3c-1.44 0-2.32-.6-2.9-1.04l-.02 4.63-4.12.87V5.57h3.76l.08 1.02a4.7 4.7 0 0 1 3.23-1.29c2.9 0 5.62 2.6 5.62 7.4 0 5.23-2.7 7.6-5.65 7.6zM40 8.95c-.95 0-1.54.34-1.97.81l.02 6.12c.4.44.98.78 1.95.78 1.52 0 2.54-1.65 2.54-3.87 0-2.15-1.04-3.84-2.54-3.84zM28.24 5.57h4.13v14.44h-4.13V5.57zm0-4.7L32.37 0v3.36l-4.13.88V.88zm-4.32 9.35v9.79H19.8V5.57h3.7l.12 1.22c1-1.77 3.07-1.41 3.62-1.22v3.79c-.52-.17-2.29-.43-3.32.86zm-8.55 4.72c0 2.43 2.6 1.68 3.12 1.46v3.36c-.55.3-1.54.54-2.89.54a4.15 4.15 0 0 1-4.27-4.24l.01-13.17 4.02-.86v3.54h3.14V9.1h-3.13v5.85zm-4.91.7c0 2.97-2.31 4.66-5.73 4.66a11.2 11.2 0 0 1-4.46-.93v-3.93c1.38.75 3.1 1.31 4.46 1.31.92 0 1.53-.24 1.53-1C6.26 13.77 0 14.51 0 9.95 0 7.04 2.28 5.3 5.62 5.3c1.36 0 2.72.2 4.09.75v3.88a9.23 9.23 0 0 0-4.1-1.06c-.86 0-1.44.25-1.44.9 0 1.85 6.29.97 6.29 5.88z"/>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click="paymentGateway = 'paypal'"
                                        :class="paymentGateway === 'paypal' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'"
                                        class="py-3 px-4 font-semibold text-sm flex items-center justify-center gap-2 transition-colors"
                                    >
                                        <svg class="h-5 w-auto" viewBox="0 0 124 33" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.145.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.031.998 1.176 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.803l1.77-11.209a.568.568 0 0 0-.561-.658zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.391-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.954.954 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678h-3.234a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.468-.895z"/>
                                            <path d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.766 17.537a.569.569 0 0 0 .562.658h3.51a.665.665 0 0 0 .656-.562l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.142-2.694-1.746-4.983-1.746zm.789 6.405c-.373 2.454-2.248 2.454-4.062 2.454h-1.031l.725-4.583a.568.568 0 0 1 .562-.481h.473c1.234 0 2.4 0 3.002.704.359.42.468 1.044.331 1.906zM115.434 13.075h-3.273a.567.567 0 0 0-.562.481l-.145.916-.23-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.311 6.586-.312 1.918.131 3.752 1.219 5.031 1 1.176 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .564.66h2.949a.95.95 0 0 0 .938-.803l1.771-11.209a.571.571 0 0 0-.565-.658zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.484-.574-.666-1.391-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .867-.34.938-.803l2.768-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.561.482z"/>
                                            <path d="M7.266 29.154l.523-3.322-1.165-.027H1.061L4.927 1.292a.316.316 0 0 1 .314-.268h9.38c3.114 0 5.263.648 6.385 1.927.526.6.861 1.227 1.023 1.917.17.724.173 1.589.007 2.644l-.012.077v.676l.526.298a3.69 3.69 0 0 1 1.065.812c.45.513.741 1.165.864 1.938.127.795.085 1.741-.123 2.812-.24 1.232-.628 2.305-1.152 3.183a6.547 6.547 0 0 1-1.825 2c-.696.494-1.523.869-2.458 1.109-.906.236-1.939.355-3.072.355h-.73c-.522 0-1.029.188-1.427.525a2.21 2.21 0 0 0-.744 1.328l-.055.299-.924 5.855-.042.215c-.011.068-.03.102-.058.125a.155.155 0 0 1-.096.035H7.266z"/>
                                            <path d="M23.048 7.667c-.028.179-.06.362-.096.55-1.237 6.351-5.469 8.545-10.874 8.545H9.326c-.661 0-1.218.48-1.321 1.132L6.596 26.83l-.399 2.533a.704.704 0 0 0 .695.814h4.881c.578 0 1.069-.42 1.16-.99l.048-.248.919-5.832.059-.32c.09-.572.582-.992 1.16-.992h.73c4.729 0 8.431-1.92 9.513-7.476.452-2.321.218-4.259-.978-5.622a4.667 4.667 0 0 0-1.336-1.03z"/>
                                        </svg>
                                    </button>
                                </div>

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

                                {{-- Stripe Payment Section --}}
                                <div x-show="paymentGateway === 'stripe'">
                                    {{-- Card Details --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Card Details *</label>
                                        <div id="card-element" class="py-3 px-4 border-2 border-gray-300 rounded"></div>
                                        <div id="card-errors" class="text-red-600 text-sm mt-2" x-text="cardError"></div>
                                    </div>

                                    {{-- Process Payment Button (Stripe) --}}
                                    <button
                                        type="button"
                                        @click="processStripePayment()"
                                        :disabled="processing"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded transition-colors text-lg uppercase tracking-wide disabled:opacity-50 disabled:cursor-not-allowed"
                                    >
                                        <span x-show="!processing">💳 Complete Donation</span>
                                        <span x-show="processing">Processing...</span>
                                    </button>

                                    <p class="text-xs text-gray-500 text-center">
                                        🔒 Your payment is secure and encrypted by Stripe
                                    </p>
                                </div>

                                {{-- PayPal Payment Section --}}
                                <div x-show="paymentGateway === 'paypal'">
                                    <div id="paypal-container" class="mb-4"></div>
                                    
                                    <p x-show="!paypalButtonsInitialized" class="text-center text-gray-600 py-4">
                                        Initializing PayPal...
                                    </p>

                                    <p class="text-xs text-gray-500 text-center">
                                        🔒 Your payment is secure and encrypted by PayPal
                                    </p>
                                </div>
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
                Secure payment processed by Stripe or PayPal
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
                    All payments are processed securely through Stripe or PayPal with bank-level encryption.
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
                    Yes! You can contact us directly at <a href="mailto:info@educatetheorphans.com" class="text-green-600 font-semibold hover:underline">info@educatetheorphans.com</a> to discuss other giving options such as bank transfers, corporate donations, or grants.
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
        paymentGateway: 'stripe',
        paypalButtonsInitialized: false,
        paypalInitializing: false,
        paypalButtonsInstance: null,
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
                        if (this.paymentGateway === 'stripe') {
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
                        } else if (this.paymentGateway === 'paypal' && !this.paypalButtonsInitialized) {
                            this.initializePayPalButtons();
                        }
                    });
                } else {
                    this.paypalButtonsInitialized = false;
                    this.paypalInitializing = false;

                    if (this.paypalButtonsInstance && typeof this.paypalButtonsInstance.close === 'function') {
                        this.paypalButtonsInstance.close();
                    }

                    this.paypalButtonsInstance = null;

                    const container = document.getElementById('paypal-container');
                    if (container) {
                        container.innerHTML = '';
                    }
                }
            });

            // Watch for payment gateway changes
            this.$watch('paymentGateway', (value) => {
                if (value === 'paypal' && !this.paypalButtonsInitialized && this.showPaymentModal) {
                    this.$nextTick(() => {
                        this.initializePayPalButtons();
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

        initializePayPalButtons() {
            if (this.paypalButtonsInitialized || this.paypalInitializing) {
                return;
            }

            if (typeof paypal === 'undefined' || !paypal.Buttons) {
                return;
            }

            const container = document.getElementById('paypal-container');
            if (!container) {
                return;
            }

            this.paypalInitializing = true;
            container.innerHTML = '';

            if (this.paypalButtonsInstance && typeof this.paypalButtonsInstance.close === 'function') {
                this.paypalButtonsInstance.close();
            }

            const self = this;

            this.paypalButtonsInstance = paypal.Buttons({
                createOrder: async (data, actions) => {
                    try {
                        if (!self.donorEmail || self.amount < 1) {
                            throw new Error('Please enter a valid email and donation amount before paying with PayPal.');
                        }

                        const response = await fetch('/paypal/create-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                amount: self.amount,
                                frequency: self.frequency === 'monthly' ? 'monthly' : 'one-time',
                                donor_email: self.donorEmail,
                                gift_aid: self.giftAidEnabled,
                                gift_aid_title: self.giftAidEnabled ? self.giftAid.title : null,
                                gift_aid_first_name: self.giftAidEnabled ? self.giftAid.firstName : null,
                                gift_aid_last_name: self.giftAidEnabled ? self.giftAid.lastName : null,
                                gift_aid_address_line1: self.giftAidEnabled ? self.giftAid.addressLine1 : null,
                                gift_aid_address_line2: self.giftAidEnabled ? self.giftAid.addressLine2 : null,
                                gift_aid_city: self.giftAidEnabled ? self.giftAid.city : null,
                                gift_aid_postcode: self.giftAidEnabled ? self.giftAid.postcode : null,
                                aggregated_donations: self.giftAidEnabled ? self.giftAid.aggregatedDonations : null,
                                sponsored_event: self.giftAidEnabled ? self.giftAid.sponsoredEvent : false
                            })
                        });

                        const raw = await response.text();
                        let payload = {};

                        if (raw) {
                            try {
                                payload = JSON.parse(raw);
                            } catch (e) {
                                console.error('PayPal order creation - JSON parse error:', e, raw);
                                throw new Error('Server returned an invalid response while creating PayPal order.');
                            }
                        }

                        if (!response.ok) {
                            console.error('PayPal order creation failed:', payload);
                            throw new Error(payload.error || 'Failed to create PayPal order');
                        }

                        if (!payload.orderId) {
                            console.error('PayPal order creation - No order ID:', payload);
                            throw new Error(payload.error || 'PayPal order ID was not returned by the server.');
                        }

                        console.log('PayPal order created successfully:', payload.orderId);
                        return payload.orderId;
                    } catch (error) {
                        console.error('PayPal createOrder error:', error);
                        alert('Error: ' + error.message);
                        throw error;
                    }
                },

                onApprove: async (data, actions) => {
                    try {
                        self.processing = true;

                        const response = await fetch('/paypal/capture-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                paypal_order_id: data.orderID
                            })
                        });

                        const raw = await response.text();
                        let result = {};

                        if (raw) {
                            try {
                                result = JSON.parse(raw);
                            } catch (e) {
                                console.error('PayPal capture - JSON parse error:', e, raw);
                                throw new Error('Server returned an invalid response while capturing PayPal payment.');
                            }
                        }

                        if (!response.ok) {
                            console.error('PayPal capture failed:', result);
                            throw new Error(result.error || 'Payment capture failed');
                        }

                        console.log('PayPal payment captured successfully');
                        self.success = true;
                        self.processing = false;
                        self.resetForm();
                    } catch (error) {
                        console.error('PayPal capture error:', error);
                        alert('Error: ' + error.message);
                        self.processing = false;
                    }
                },

                onError: (error) => {
                    console.error('PayPal button error:', error);
                    alert('Payment failed: ' + (error.message || 'An unknown error occurred'));
                    self.processing = false;
                }
            });

            this.paypalButtonsInstance.render('#paypal-container')
                .then(() => {
                    this.paypalButtonsInitialized = true;
                })
                .catch((error) => {
                    console.error('PayPal render error:', error);
                    alert('Unable to load PayPal buttons. Please refresh and try again.');
                })
                .finally(() => {
                    this.paypalInitializing = false;
                });
        },

        async processStripePayment() {
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
