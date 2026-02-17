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
                <h1 class="text-5xl font-bold leading-tight">Contact Us</h1>
                <p class="mt-5 text-lg text-gray-200">We'd love to hear from you. Reach out with questions, partnership ideas, or to learn more about ETO.</p>
            </div>
        </div>
    </div>
</section>

{{-- CONTACT INFO + FORM --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid gap-10 md:grid-cols-2">

            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Get in Touch</h2>

                <div class="space-y-6">
                    <!-- Email -->
                    <div>
                        <p class="font-semibold text-lg">Email</p>
                        <p class="mt-2 text-gray-700">
                            <a href="mailto:info@eto-ministries.org" class="text-blue-600 hover:underline">
                                info@eto-ministries.org
                            </a>
                        </p>
                        <p class="text-sm text-gray-600 mt-1">We reply to all inquiries within 48 hours</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <p class="font-semibold text-lg">Phone</p>
                        <p class="mt-2 text-gray-700">
                            <a href="tel:+254..." class="text-blue-600 hover:underline">
                                Available by request
                            </a>
                        </p>
                        <p class="text-sm text-gray-600 mt-1">Contact via email to arrange a call</p>
                    </div>

                    <!-- Physical Address -->
                    <div>
                        <p class="font-semibold text-lg">Location</p>
                        <p class="mt-2 text-gray-700">
                            Tharaka District<br>
                            Eastern Kenya
                        </p>
                        <p class="text-sm text-gray-600 mt-1">Field office serving the Tharaka community</p>
                    </div>

                    <!-- Mailing Address -->
                    <div>
                        <p class="font-semibold text-lg">Mailing Address</p>
                        <p class="mt-2 text-gray-700 text-sm">
                            Educate the Orphans<br>
                            P.O. Box [City], [Country]<br>
                            (Update with your actual mailing address)
                        </p>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-10 pt-8 border-t">
                    <p class="font-semibold text-lg mb-4">Follow Us</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-700 hover:text-blue-600 font-semibold">Facebook</a>
                        <a href="#" class="text-gray-700 hover:text-pink-600 font-semibold">Instagram</a>
                        <a href="#" class="text-gray-700 hover:text-blue-400 font-semibold">Twitter</a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="rounded-2xl border p-8 bg-gray-50">
                <h3 class="text-2xl font-bold mb-6">Send us a Message</h3>

                <form action="#" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block font-semibold text-sm mb-2">Your Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full rounded-lg border px-4 py-2"
                            placeholder="John Doe"
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-semibold text-sm mb-2">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full rounded-lg border px-4 py-2"
                            placeholder="john@example.com"
                        >
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block font-semibold text-sm mb-2">Subject</label>
                        <select
                            id="subject"
                            name="subject"
                            required
                            class="w-full rounded-lg border px-4 py-2"
                        >
                            <option value="">Select a topic...</option>
                            <option value="sponsorship">Child Sponsorship</option>
                            <option value="donation">Make a Donation</option>
                            <option value="volunteer">Volunteer Opportunity</option>
                            <option value="partnership">Partnership/Business</option>
                            <option value="prayer">Prayer Request</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block font-semibold text-sm mb-2">Message</label>
                        <textarea
                            id="message"
                            name="message"
                            required
                            rows="5"
                            class="w-full rounded-lg border px-4 py-2"
                            placeholder="Tell us how we can help..."
                        ></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition"
                    >
                        Send Message
                    </button>

                    <p class="text-xs text-gray-600 text-center">
                        We'll get back to you as soon as possible
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-16 bg-gray-50 border-y">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold mb-10">Frequently Asked Questions</h2>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">How can I sponsor a child?</h3>
                <p class="text-gray-700 text-sm">
                    Visit our sponsorship page or contact us directly. Our team will help match you with a child and explain the program details.
                </p>
            </div>

            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">Where does my donation go?</h3>
                <p class="text-gray-700 text-sm">
                    100% of donations go directly to programs and services. We maintain full transparency through financial reports and impact updates.
                </p>
            </div>

            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">Can I volunteer in Kenya?</h3>
                <p class="text-gray-700 text-sm">
                    Yes! We arrange volunteer opportunities. Contact us to discuss your skills, timeline, and interests. We also offer remote volunteering options.
                </p>
            </div>

            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">How can businesses partner with ETO?</h3>
                <p class="text-gray-700 text-sm">
                    We welcome corporate partnerships, team projects, and supply donations. Email us to discuss partnership opportunities tailored to your company.
                </p>
            </div>

            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">How often will I hear from my sponsored child?</h3>
                <p class="text-gray-700 text-sm">
                    You'll receive quarterly updates with photos, progress reports, and letters. Communication frequency depends on the child's ability to write.
                </p>
            </div>

            <div class="border rounded-lg p-6 bg-white">
                <h3 class="font-bold text-lg mb-2">Is my donation tax-deductible?</h3>
                <p class="text-gray-700 text-sm">
                    Yes, ETO is a registered nonprofit. You'll receive a tax receipt for your donations. Contact us for specific tax information for your region.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16">
    <div class="mx-auto max-w-6xl px-4 text-center">
        <h2 class="text-3xl font-bold">Ready to Connect?</h2>
        <p class="mt-4 text-gray-700 max-w-2xl mx-auto">
            Whether you have a question, want to sponsor a child, or explore partnership opportunities—we're here and eager to hear from you.
        </p>
        <div class="mt-8">
            <a href="mailto:info@eto-ministries.org" class="inline-block rounded-lg bg-green-600 text-white px-6 py-3 font-semibold hover:bg-green-700">
                Email Us Today
            </a>
        </div>
    </div>
</section>

@endsection
