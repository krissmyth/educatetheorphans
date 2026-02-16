@extends('layouts.public')

@section('content')
    <section class="py-10">
        <h1 class="text-4xl font-bold tracking-tight">Educate The Orphans</h1>
        <p class="mt-4 text-lg text-gray-700 max-w-2xl">
            Building a future through education.
        </p>

        <div class="mt-8 flex gap-3">
            <a href="/donate" class="inline-flex items-center rounded-lg bg-black px-5 py-3 text-white text-sm font-semibold">
                Donate Now
            </a>
            <a href="/programs" class="inline-flex items-center rounded-lg border px-5 py-3 text-sm font-semibold">
                See Our Programs
            </a>
        </div>
    </section>
@endsection
