@extends('layouts.public')

@section('title', $item->title . ' - Educate the Orphans')
@section('meta_description', $item->preview ?? 'Read the latest update from Educate the Orphans.')

@section('content')

<div class="mx-auto max-w-4xl px-4 py-16">
    <!-- Back Link -->
    <a href="{{ route('news') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to News
    </a>

    <!-- Header -->
    <header class="border-b pb-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $item->title }}</h1>

        @if ($item->sent_at)
            <p class="text-sm text-gray-500 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <time datetime="{{ $item->sent_at->toDateString() }}">
                    {{ $item->sent_at->format('F j, Y') }}
                </time>
            </p>
        @endif
    </header>

    <!-- Content -->
    <div class="mb-12">
        @if ($item->content)
            <div class="bg-white border rounded-lg p-8 campaign-content">
                {!! $item->content !!}
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-gray-600">No content available for this update.</p>
            </div>
        @endif
    </div>

    <!-- Related Articles -->
    @if ($related->isNotEmpty())
        <section class="border-t pt-8">
            <h2 class="text-2xl font-bold mb-6">More Updates</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($related as $rel)
                    <a href="{{ route('news.show', $rel->id) }}" class="border rounded-lg p-6 hover:shadow-lg transition group">
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition line-clamp-2 mb-2">
                            {{ $rel->title }}
                        </h3>
                        @if ($rel->sent_at)
                            <p class="text-xs text-gray-500">{{ $rel->sent_at->format('F j, Y') }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>

<style>
    .campaign-content { word-break: break-word; }
    .campaign-content a { color: #16a34a; text-decoration: underline; }
    .campaign-content a:hover { color: #15803d; }
    .campaign-content img { max-width: 100%; height: auto; display: block; margin: 1rem 0; }
    .campaign-content h1, .campaign-content h2, .campaign-content h3 { color: #111827; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .campaign-content p { margin-bottom: 1rem; line-height: 1.75; }
</style>

@endsection
