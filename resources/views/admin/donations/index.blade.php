@extends('layouts.admin')

@section('page-title', 'Donation Management')

@section('content')

@if(session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
        {{ $errors->first() }}
    </div>
@endif

{{-- Statistics Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Total Donations</div>
        <div class="text-2xl font-bold text-green-600">£{{ number_format($stats['total_donations'], 2) }}</div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Gift Aid Donations</div>
        <div class="text-2xl font-bold text-blue-600">£{{ number_format($stats['total_gift_aid'], 2) }}</div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Gift Aid to Claim</div>
        <div class="text-2xl font-bold text-purple-600">£{{ number_format($stats['gift_aid_to_claim'], 2) }}</div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Monthly Donors</div>
        <div class="text-2xl font-bold text-orange-600">{{ $stats['monthly_donors'] }}</div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">One-Time Donors</div>
        <div class="text-2xl font-bold text-gray-600">{{ $stats['one_time_donors'] }}</div>
    </div>
</div>

{{-- Filters & Export --}}
<div class="bg-white rounded-lg shadow mb-6">
    <form method="GET" action="{{ route('admin.donations.index') }}" class="p-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start gap-2">
                <div class="text-blue-600 text-xl">ℹ️</div>
                <div>
                    <h3 class="text-sm font-bold text-blue-900 mb-1">HMRC Gift Aid Export</h3>
                    <p class="text-xs text-blue-700">Export format: Title (max 4) | First name/initial (max 35, no spaces) | Last name (max 35) | House name/number (max 40) | Postcode (UPPER CASE with space) | Aggregated donations (description only) | Sponsored event (Yes or blank) | Donation date (DD/MM/YY) | Amount (no £ sign)</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gift Aid</label>
                <select name="gift_aid" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                    <option value="">All Donations</option>
                    <option value="yes" {{ request('gift_aid') === 'yes' ? 'selected' : '' }}>Gift Aid Only</option>
                    <option value="no" {{ request('gift_aid') === 'no' ? 'selected' : '' }}>No Gift Aid</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Frequency</label>
                <select name="frequency" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                    <option value="">All Types</option>
                    <option value="one-time" {{ request('frequency') === 'one-time' ? 'selected' : '' }}>One-Time</option>
                    <option value="monthly" {{ request('frequency') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Search (email or name)</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donations..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors">
                    🔍 Filter
                </button>
                <a href="{{ route('admin.donations.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-semibold transition-colors">
                    Clear
                </a>
                <a href="{{ route('admin.donations.export-gift-aid', request()->all()) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors ml-auto">
                    📥 Export HMRC Gift Aid CSV
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Donations Table --}}
<div class="bg-white rounded-lg shadow overflow-hidden" x-data="{ selectedDonationIds: [], pageDonationIds: @js($donations->pluck('id')->all()) }">
    <form method="POST" action="{{ route('admin.donations.bulk-destroy') }}" @submit.prevent="if (selectedDonationIds.length && confirm('Delete selected donation(s)? This cannot be undone.')) { $el.submit(); }">
        @csrf
        @method('DELETE')

        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <p class="text-sm text-gray-600"><span x-text="selectedDonationIds.length"></span> selected</p>
            <div class="flex items-center gap-3">
                <button type="button" @click="selectedDonationIds = [...pageDonationIds]" class="text-sm text-blue-600 hover:text-blue-800 font-semibold">
                    Select all on this page
                </button>
                <button type="button" @click="selectedDonationIds = []" class="text-sm text-gray-600 hover:text-gray-800 font-semibold">
                    Clear selection
                </button>
                <button type="submit" :disabled="selectedDonationIds.length === 0" class="px-4 py-2 bg-red-600 hover:bg-red-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg font-semibold transition-colors">
                    Delete selected
                </button>
            </div>
        </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            @change="selectedDonationIds = $event.target.checked ? [...pageDonationIds] : []"
                            :checked="pageDonationIds.length > 0 && selectedDonationIds.length === pageDonationIds.length"
                            class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                        >
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Frequency</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gift Aid</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($donations as $donation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            <input
                                type="checkbox"
                                name="donation_ids[]"
                                value="{{ $donation->id }}"
                                x-model="selectedDonationIds"
                                class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                            >
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $donation->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $donation->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $donation->donor_name ?: 'N/A' }}</div>
                            <div class="text-gray-500">{{ $donation->donor_email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            £{{ number_format($donation->amount, 2) }}
                            @if($donation->gift_aid_eligible)
                                <span class="block text-xs text-green-600">+£{{ number_format($donation->gift_aid_amount, 2) }} Gift Aid</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $donation->frequency === 'monthly' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($donation->frequency) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($donation->gift_aid_eligible)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">✓ Yes</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-semibold">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'failed' => 'bg-red-100 text-red-800',
                                    'refunded' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$donation->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.donations.show', $donation) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                            No donations found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </form>

    {{-- Pagination --}}
    @if($donations->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $donations->links() }}
        </div>
    @endif
</div>

@endsection
