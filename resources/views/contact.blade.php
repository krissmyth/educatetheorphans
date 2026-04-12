@extends('layouts.public')

@section('title', 'Contact Us - Educate the Orphans')
@section('meta_description', 'Get in touch with Educate the Orphans. Ask about child sponsorship, donations, speaking engagements, volunteering, or partnership opportunities.')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="{{ asset('images/contacts.jpg') }}"
        class="h-[560px] w-full object-cover"
        alt="Contact Us"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-end pb-12">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Get In Touch</h1>
                <p class="mt-4 text-lg text-gray-200">We'd love to hear from you. Reach out with any questions, partnership ideas, or to learn more about our work.</p>
            </div>
        </div>
    </div>
</section>

{{-- CONTACT INFO CARDS --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Email -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">✉️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600 text-sm mb-2">
                    <a href="mailto:info@educatetheorphans.com" class="font-semibold text-gray-900 hover:text-green-600">
                        info@educatetheorphans.com
                    </a>
                </p>
                <p class="text-xs text-gray-500">We'll get back to you soon</p>
            </div>

            <!-- Location -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">📍</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Location</h3>
                <p class="text-gray-600 text-sm mb-2 font-semibold">
                    UK & Ireland<br>
                    & Tharaka, Kenya
                </p>
                
            </div>

            <!-- Social Media -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">📱</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Follow Us</h3>
                <div class="flex gap-3 mt-4">
                    <a href="https://www.facebook.com/EducatetheOrphans" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
<a href="https://www.youtube.com/channel/UCwqCS6I8bGI16yf1iM0h7dw?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-red-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Volunteer Run -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">❤️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Volunteer-Run</h3>
                <p class="text-gray-600 text-sm">Our UK & Ireland team is entirely volunteer-run, giving their time for God's work.</p>
                <p class="text-xs text-gray-500 mt-2">We'll respond as soon as we can</p>
            </div>
        </div>
    </div>
</section>

{{-- REASONS TO CONNECT --}}
<section class="py-16 bg-white">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold text-center mb-4">Ways to Connect With Us</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
            There are many ways to get involved with Educate the Orphans. Whether you want to learn more about our work, explore partnership opportunities, or invite us to speak at your church or organisation, we'd love to hear from you.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Speaking Engagements -->
            <div class="rounded-2xl border p-8 bg-gray-50 hover:shadow-lg transition">
                <div class="text-4xl mb-4">🎤</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Speaking Engagements</h3>
                <p class="text-gray-700 mb-4">
                    We'd be honoured to share about our work at your church, small group, school, or community organisation. Contact us to discuss available dates.
                </p>
            </div>

            <!-- Prayer Support -->
            <div class="rounded-2xl border p-8 bg-gray-50 hover:shadow-lg transition">
                <div class="text-4xl mb-4">🙏</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Prayer Support</h3>
                <p class="text-gray-700 mb-4">
                    Prayer is at the heart of everything we do. Join our WhatsApp prayer group to intercede for the children, families, and communities we serve in Kenya.
                </p>
                <div class="flex flex-col items-center gap-2">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=https%3A%2F%2Fchat.whatsapp.com%2FDGiYTyGNo1CBfaEaBtTYRT%3Fmode%3Dgi_t"
                        alt="Scan to join ETO Prayer WhatsApp Group"
                        class="rounded-lg border p-1 bg-white"
                        width="140" height="140"
                    >
                    <p class="text-xs text-gray-500">Scan to join our prayer WhatsApp group</p>
                    <a href="https://chat.whatsapp.com/DGiYTyGNo1CBfaEaBtTYRT?mode=gi_t" target="_blank" rel="noopener" class="text-sm font-semibold text-green-600 hover:underline">
                        Or tap here to join →
                    </a>
                </div>
            </div>

            <!-- Learn More -->
            <div class="rounded-2xl border p-8 bg-gray-50 hover:shadow-lg transition">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Learn More About Us</h3>
                <p class="text-gray-700 mb-4">
                    Want to know more about our programmes, impact, or team?
                </p>
                <p class="text-gray-700 mb-4">
                    Get in touch — we're committed to transparency and happy to answer your questions.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CONTACT FORM --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-2xl px-4">
        <h2 class="text-3xl font-bold text-center mb-4">Send us a Message</h2>
        <p class="text-center text-gray-600 mb-12">
            Have a question or want to get involved? Fill out the form below and we'll be in touch.
        </p>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                <p class="text-green-800 font-semibold">✓ {{ session('success') }}</p>
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <p class="text-red-800 font-semibold">✗ {{ session('error') }}</p>
            </div>
        @endif

        <div class="rounded-2xl border bg-white p-8 md:p-12">
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Honeypot — hidden from real users, bots fill it in --}}
                <div aria-hidden="true" style="position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden;">
                    <label for="website">Leave this empty</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" value="">
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block font-semibold text-gray-900 mb-3">Your Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('name') border-red-500 @enderror"
                        placeholder="John Doe"
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-semibold text-gray-900 mb-3">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('email') border-red-500 @enderror"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block font-semibold text-gray-900 mb-3">What's this about?</label>
                    <select
                        id="subject"
                        name="subject"
                        required
                        class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('subject') border-red-500 @enderror"
                    >
                        <option value="" disabled selected>Select a topic...</option>
                        <option value="Find Out More About Our Work" @selected(old('subject') === 'Find Out More About Our Work')>Find Out More About Our Work</option>
                        <option value="Make a Donation" @selected(old('subject') === 'Make a Donation')>Make a Donation</option>
                        <option value="Fundraise for Us" @selected(old('subject') === 'Fundraise for Us')>Fundraise for Us</option>
                        <option value="Speaking Request" @selected(old('subject') === 'Speaking Request')>Speaking Request</option>
                        <option value="Prayer Request" @selected(old('subject') === 'Prayer Request')>Prayer Request</option>
<option value="General Enquiry" @selected(old('subject') === 'General Enquiry')>General Enquiry</option>
                        <option value="Other" @selected(old('subject') === 'Other')>Other</option>
                    </select>
                    @error('subject')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block font-semibold text-gray-900 mb-3">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        required
                        rows="6"
                        class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-600 @error('message') border-red-500 @enderror"
                        placeholder="Tell us how we can help..."
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition disabled:opacity-50"
                >
                    Send Message
                </button>

                <p class="text-xs text-gray-600 text-center">
                    We are a volunteer team — we'll review your message and get back to you as soon as we can.
                </p>
            </form>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Where does my donation go?</h3>
                <p class="text-gray-700">
                    100% of donations go directly to programmes and services supporting children and communities in Tharaka, Kenya. We are committed to full transparency.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can I fundraise for ETO?</h3>
                <p class="text-gray-700">
                    Whether it's a sponsored event, a church collection, or a personal challenge, we'd love to support you. Get in touch and our volunteer team will help you get started.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Can I invite ETO to speak at my church or group?</h3>
                <p class="text-gray-700">
                    Yes — we'd be honoured to share about our work in Kenya. Contact us to discuss available dates and we'll do our best to come along.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can I pray for the work in Kenya?</h3>
                <p class="text-gray-700">
                    Prayer is at the heart of everything we do. You can join our WhatsApp prayer group by scanning the QR code above, or sign up to our newsletter to receive regular prayer updates.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Who runs Educate the Orphans?</h3>
                <p class="text-gray-700">
                    Our UK & Ireland team is entirely volunteer-run, giving their time for God's work. We also work closely with our Kenya Director, Livingstone Njeru, who himself was a sponsored child through ETO.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Can UK taxpayers claim Gift Aid?</h3>
                <p class="text-gray-700">
                    Yes! If you're a UK taxpayer, your donation is worth 25% more at no extra cost to you through Gift Aid. This is handled automatically when you donate through JustGiving.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-16 bg-gradient-to-r from-green-600 to-emerald-600">
    <div class="mx-auto max-w-6xl px-4 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Support Our Work in Kenya</h2>
        <p class="text-lg text-green-50 max-w-2xl mx-auto mb-4">
            Your generosity makes a direct difference to the children and families we serve. Every donation — however large or small — goes straight to those who need it most.
        </p>
        <div class="flex flex-wrap justify-center gap-6 max-w-2xl mx-auto mb-8 text-sm text-green-100">
            <div class="flex items-center gap-2">
                <span class="text-white font-bold text-lg">100%</span>
                <span>of every donation goes directly to our work in Kenya</span>
            </div>
            <div class="flex items-center gap-2">
                <span>❤️</span>
                <span>Our entire UK & Ireland team give their time freely as volunteers</span>
            </div>
        </div>
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
</section>

@endsection
