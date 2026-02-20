@extends('layouts.public')

@section('content')

<div class="mx-auto max-w-4xl px-4 py-16">
    <!-- Back Link -->
    <a href="{{ route('news') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to News
    </a>

    <!-- Campaign Header -->
    <header class="border-b pb-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $campaign['subject'] }}</h1>

        <!-- Meta Information -->
        <div class="flex flex-wrap gap-6 text-sm text-gray-600">
            @if ($campaign['send_time'])
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <time datetime="{{ $campaign['send_time'] }}">
                        {{ \Carbon\Carbon::parse($campaign['send_time'])->format('F j, Y') }}
                    </time>
                </div>
            @endif
        </div>
    </header>

    <!-- Campaign Content -->
    <div class="prose prose-lg max-w-none mb-12">
        @if ($content)
            <!-- Display HTML content with basic sanitization -->
            <div class="bg-white border rounded-lg p-8 mb-8 campaign-content">
                {!! $content !!}
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-gray-600">No content available for this campaign.</p>
            </div>
        @endif
    </div>

    <!-- Related Campaigns -->
    @if (!empty($relatedCampaigns))
        <section class="border-t pt-8">
            <h2 class="text-2xl font-bold mb-6">Related Campaigns</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($relatedCampaigns as $related)
                    <a href="{{ route('news.show', $related['id']) }}" class="border rounded-lg p-6 hover:shadow-lg transition group">
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition line-clamp-2 mb-2">
                            {{ $related['subject'] }}
                        </h3>
                        @if ($related['send_time'])
                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($related['send_time'])->format('F j, Y') }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>

<style>
    /* Additional styling for campaign content */
    .campaign-content {
        word-break: break-word;
    }

    .campaign-content a {
        colour: #16a34a;
        text-decoration: underline;
    }

    .campaign-content a:hover {
        colour: #15803d;
    }

    .campaign-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1rem 0;
    }

    .campaign-content h1,
    .campaign-content h2,
    .campaign-content h3 {
        colour: #111827;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .campaign-content p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }
</style>

@endsection
