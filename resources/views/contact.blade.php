@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="relative">
    <img
        src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=2000&q=80"
        class="h-[560px] w-full object-cover"
        alt="Contact Us"
    >
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0">
        <div class="mx-auto max-w-6xl px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold leading-tight">Get In Touch</h1>
                <p class="mt-5 text-lg text-gray-200">We'd love to hear from you. Reach out with any questions, partnership ideas, or to learn more about our work.</p>
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
                    <a href="mailto:info@educatetheorphans.org" class="font-semibold text-gray-900 hover:text-green-600">
                        info@educatetheorphans.org
                    </a>
                </p>
                <p class="text-xs text-gray-500">We reply within 48 hours</p>
            </div>

            <!-- Location -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">📍</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Location</h3>
                <p class="text-gray-600 text-sm mb-2 font-semibold">
                    Tharaka District<br>
                    Eastern Kenya
                </p>
                <p class="text-xs text-gray-500">Field office</p>
            </div>

            <!-- Social Media -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">📱</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Follow Us</h3>
                <div class="flex gap-3 mt-4">
                    <a href="https://www.facebook.com/EducatetheOrphans" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/etoministries/" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-pink-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12s12-5.373 12-12c0-6.627-5.373-12-12-12zm0 2.16c2.686 0 3.006.01 4.061.059 2.537.115 3.855 1.465 3.97 3.97.048 1.056.058 1.376.058 4.061 0 2.686-.01 3.006-.059 4.061-.115 2.504-1.434 3.855-3.97 3.97-1.056.048-1.376.058-4.061.058-2.686 0-3.006-.01-4.061-.059-2.504-.115-3.856-1.465-3.971-3.97-.047-1.056-.058-1.376-.058-4.061 0-2.686.01-3.006.059-4.061.115-2.504 1.465-3.855 3.97-3.97 1.056-.047 1.376-.058 4.061-.058zm0 3.68c-2.263 0-4.16 1.897-4.16 4.16s1.897 4.16 4.16 4.16 4.16-1.897 4.16-4.16-1.897-4.16-4.16-4.16zm0 6.86c-1.488 0-2.7-1.212-2.7-2.7s1.212-2.7 2.7-2.7 2.7 1.212 2.7 2.7-1.212 2.7-2.7 2.7zm5.338-7.44c-.53 0-.96.43-.96.96s.43.96.96.96.96-.43.96-.96-.43-.96-.96-.96z"/></svg>
                    </a>
                    <a href="https://x.com/EtoMinistries" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-blue-400 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417a9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/channel/UCwqCS6I8bGI16yf1iM0h7dw?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-red-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Response Time -->
            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <div class="text-3xl mb-4">⏱️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Response Time</h3>
                <p class="text-gray-600 text-sm font-semibold">48 hours</p>
                <p class="text-xs text-gray-500 mt-2">We'll get back to you soon</p>
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
                    We'd be honoured to share about our work at your church, small group, school, or community organisation. Contact us to discuss available dates and topics.
                </p>
            </div>

            <!-- Partnership Opportunities -->
            <div class="rounded-2xl border p-8 bg-gray-50 hover:shadow-lg transition">
                <div class="text-4xl mb-4">🤝</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Partnership Opportunities</h3>
                <p class="text-gray-700 mb-4">
                    Interested in corporate partnerships, grants, or unique collaboration ideas? We'd love to explore how we can work together to make an impact.
                </p>
            </div>

            <!-- Learn More -->
            <div class="rounded-2xl border p-8 bg-gray-50 hover:shadow-lg transition">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Learn More About Us</h3>
                <p class="text-gray-700 mb-4">
                    Want to know more about our programmes, impact, financial reports, or team? Get in touch—we're committed to transparency and happy to answer your questions.
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
                        <option value="">Select a topic...</option>
                        <option value="Child Sponsorship" @selected(old('subject') === 'Child Sponsorship')>Child Sponsorship</option>
                        <option value="Make a Donation" @selected(old('subject') === 'Make a Donation')>Make a Donation</option>
                        <option value="Speaking Request" @selected(old('subject') === 'Speaking Request')>Speaking Request</option>
                        <option value="Volunteer Opportunity" @selected(old('subject') === 'Volunteer Opportunity')>Volunteer Opportunity</option>
                        <option value="Partnership/Business" @selected(old('subject') === 'Partnership/Business')>Partnership/Business</option>
                        <option value="Prayer Request" @selected(old('subject') === 'Prayer Request')>Prayer Request</option>
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
                    We'll review your message and get back to you within 48 hours.
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
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can I sponsor a child?</h3>
                <p class="text-gray-700">
                    Contact us directly to get started. Our team will help match you with a child and explain the sponsorship programme in detail.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Where does my donation go?</h3>
                <p class="text-gray-700">
                    100% of donations go directly to programmes and services. We maintain full transparency through regular financial reports.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Can I volunteer in Kenya?</h3>
                <p class="text-gray-700">
                    Yes! We arrange volunteer opportunities based on your skills and timeline. We also offer remote volunteering options.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How can businesses partner with us?</h3>
                <p class="text-gray-700">
                    We welcome corporate partnerships and team projects. Email us to discuss opportunities tailored to your company.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">How often will I hear from my sponsored child?</h3>
                <p class="text-gray-700">
                    You'll receive quarterly updates with photos and progress reports. We encourage direct communication with sponsored children.
                </p>
            </div>

            <div class="rounded-2xl border p-8 bg-white hover:shadow-lg transition">
                <h3 class="font-bold text-lg text-gray-900 mb-3">Is my donation tax-deductible?</h3>
                <p class="text-gray-700">
                    Yes! Educate the Orphans is a registered nonprofit. You'll receive a tax receipt for your donations.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-16 bg-gradient-to-r from-green-600 to-emerald-600">
    <div class="mx-auto max-w-6xl px-4 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Make a Difference?</h2>
        <p class="text-lg text-green-50 max-w-2xl mx-auto mb-8">
            Whether you want to sponsor a child, make a donation, or partner with us, we're here to help. Let's work together to transform lives.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://justgiving.com/educatetheorphans/donate" target="_blank" class="rounded-lg bg-white text-green-600 px-8 py-3 font-semibold hover:bg-gray-100 transition">
                Donate Now
            </a>
            <a href="{{ route('home') }}#get-involved" class="rounded-lg border-2 border-white text-white px-8 py-3 font-semibold hover:bg-white/10 transition">
                Get Involved
            </a>
        </div>
    </div>
</section>

@endsection
