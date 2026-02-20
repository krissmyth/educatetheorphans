@extends('layouts.admin')

@section('page-title', 'Donation #' . $donation->id)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.donations.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
        ← Back to Donations
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Main Details --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Donation Information --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold">Donation Information</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Donation ID</label>
                        <div class="text-lg font-bold">#{{ $donation->id }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Date & Time</label>
                        <div class="text-lg">{{ $donation->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Amount</label>
                        <div class="text-2xl font-bold text-green-600">£{{ number_format($donation->amount, 2) }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Status</label>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'failed' => 'bg-red-100 text-red-800',
                                'refunded' => 'bg-gray-100 text-gray-800',
                            ];
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$donation->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Frequency</label>
                        <div class="text-lg">{{ ucfirst($donation->frequency) }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Payment Method</label>
                        <div class="text-lg">{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</div>
                    </div>
                </div>

                @if($donation->completed_at)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Completed At</label>
                        <div class="text-lg">{{ $donation->completed_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Donor Information --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold">Donor Information</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                    <div class="text-lg">{{ $donation->donor_email }}</div>
                </div>

                @if($donation->donor_name)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Name</label>
                        <div class="text-lg">{{ $donation->donor_name }}</div>
                    </div>
                @endif

                @if($donation->donor_phone)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Phone</label>
                        <div class="text-lg">{{ $donation->donor_phone }}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Gift Aid Information --}}
        @if($donation->gift_aid_eligible)
            <div class="bg-green-50 border-2 border-green-200 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-green-200 bg-green-100">
                    <h2 class="text-xl font-bold text-green-900">Gift Aid Declaration ✓</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Donation Amount</label>
                                <div class="text-lg font-bold">£{{ number_format($donation->amount, 2) }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Gift Aid Amount (25%)</label>
                                <div class="text-lg font-bold text-green-600">£{{ number_format($donation->gift_aid_amount, 2) }}</div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Total Value to Charity</label>
                            <div class="text-2xl font-bold text-green-600">£{{ number_format($donation->total_with_gift_aid, 2) }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Title</label>
                            <div class="text-lg">{{ $donation->gift_aid_title }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">First Name</label>
                            <div class="text-lg">{{ $donation->gift_aid_first_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Last Name</label>
                            <div class="text-lg">{{ $donation->gift_aid_last_name }}</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Address</label>
                        <div class="text-lg">
                            {{ $donation->gift_aid_address_line1 }}<br>
                            @if($donation->gift_aid_address_line2)
                                {{ $donation->gift_aid_address_line2 }}<br>
                            @endif
                            {{ $donation->gift_aid_city }}<br>
                            {{ $donation->gift_aid_postcode }}
                        </div>
                    </div>

                    @if($donation->gift_aid_declaration_date)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Declaration Date</label>
                            <div class="text-lg">{{ $donation->gift_aid_declaration_date->format('d/m/Y') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg shadow p-6 text-center">
                <div class="text-gray-500 text-lg">No Gift Aid declaration for this donation</div>
            </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Payment Details --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold">Payment Details</h2>
            </div>
            <div class="p-6 space-y-3">
                @if($donation->stripe_payment_intent_id)
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Payment Intent ID</label>
                        <div class="text-sm font-mono break-all">{{ $donation->stripe_payment_intent_id }}</div>
                    </div>
                @endif

                @if($donation->stripe_customer_id)
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Customer ID</label>
                        <div class="text-sm font-mono break-all">{{ $donation->stripe_customer_id }}</div>
                    </div>
                @endif

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Currency</label>
                    <div class="text-sm">{{ strtoupper($donation->currency) }}</div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold">Quick Actions</h2>
            </div>
            <div class="p-6 space-y-3">
                @if($donation->gift_aid_eligible)
                    <a href="{{ route('admin.donations.export-gift-aid', ['date_from' => $donation->created_at->format('Y-m-d'), 'date_to' => $donation->created_at->format('Y-m-d')]) }}" 
                       class="block w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-lg font-semibold transition-colors">
                        📥 Export as CSV
                    </a>
                @endif
                
                <a href="mailto:{{ $donation->donor_email }}" 
                   class="block w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-center rounded-lg font-semibold transition-colors">
                    ✉️ Email Donor
                </a>
            </div>
        </div>

        {{-- Metadata --}}
        @if($donation->metadata)
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold">Metadata</h2>
                </div>
                <div class="p-6">
                    <pre class="text-xs bg-gray-50 p-3 rounded overflow-x-auto">{{ json_encode($donation->metadata, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
