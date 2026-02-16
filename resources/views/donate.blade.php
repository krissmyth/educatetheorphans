@extends('layouts.public')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-16">
    <h1 class="text-4xl font-bold">Donate</h1>
    <p class="mt-4 text-gray-700">
        Your gift helps provide education, food support, and care for vulnerable children and families.
    </p>

    <div class="mt-10 rounded-2xl border p-6 bg-gray-50">
        <p class="font-semibold">What your gift can do</p>
        <ul class="mt-4 space-y-2 text-gray-700">
            <li><span class="font-semibold">$25</span> — School supplies</li>
            <li><span class="font-semibold">$50</span> — Food support for a family</li>
            <li><span class="font-semibold">$100</span> — Education support for a student</li>
            <li><span class="font-semibold">$250</span> — Support a program/project need</li>
        </ul>

        <a href="https://www.justgiving.com/eto/donate"
           target="_blank" rel="noopener"
           class="mt-6 inline-flex items-center justify-center rounded-xl bg-black px-6 py-3 text-white font-semibold hover:bg-gray-800">
            Donate securely on JustGiving
        </a>

        <p class="mt-3 text-sm text-gray-500">
            You’ll be taken to our JustGiving page to complete your donation.
        </p>
    </div>
</div>
@endsection
