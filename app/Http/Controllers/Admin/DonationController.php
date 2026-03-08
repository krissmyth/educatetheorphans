<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display all donations with optional filters
     */
    public function index(Request $request)
    {
        $query = Donation::query()->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Gift Aid eligible
        if ($request->filled('gift_aid')) {
            $query->where('gift_aid_eligible', $request->gift_aid === 'yes');
        }

        // Filter by frequency
        if ($request->filled('frequency')) {
            $query->where('frequency', $request->frequency);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by donor email or name
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('donor_email', 'like', '%' . $request->search . '%')
                    ->orWhere('donor_name', 'like', '%' . $request->search . '%');
            });
        }

        $donations = $query->paginate(25)->withQueryString();

        // Calculate statistics
        $stats = [
            'total_donations' => Donation::where('status', 'completed')->sum('amount'),
            'total_gift_aid' => Donation::where('status', 'completed')
                ->where('gift_aid_eligible', true)
                ->sum('amount'),
            'gift_aid_to_claim' => Donation::where('status', 'completed')
                ->where('gift_aid_eligible', true)
                ->get()
                ->sum(function ($donation) {
                    return $donation->amount * 0.25;
                }),
            'monthly_donors' => Donation::where('frequency', 'monthly')
                ->where('status', 'completed')
                ->distinct('donor_email')
                ->count('donor_email'),
            'one_time_donors' => Donation::where('frequency', 'one-time')
                ->where('status', 'completed')
                ->distinct('donor_email')
                ->count('donor_email'),
        ];

        return view('admin.donations.index', compact('donations', 'stats'));
    }

    /**
     * Show individual donation details
     */
    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Delete selected donations from admin list
     */
    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'donation_ids' => ['required', 'array', 'min:1'],
            'donation_ids.*' => ['integer', 'exists:donations,id'],
        ]);

        $deletedCount = Donation::whereIn('id', $validated['donation_ids'])->delete();

        return redirect()
            ->route('admin.donations.index')
            ->with('success', $deletedCount . ' donation(s) deleted successfully.');
    }

    /**
     * Export Gift Aid donations to CSV for HMRC submission
     */
    public function exportGiftAid(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = Donation::where('status', 'completed')
            ->where('gift_aid_eligible', true);

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $donations = $query->orderBy('created_at', 'desc')->get();

        $filename = 'gift-aid-hmrc-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');

            // HMRC Required CSV Headers (exactly as required)
            fputcsv($file, [
                'Title',
                'First name or initial',
                'Last name',
                'House name or number',
                'Postcode',
                'Aggregated donations',
                'Sponsored event',
                'Donation date',
                'Amount'
            ]);

            // Data rows - formatted exactly for HMRC requirements
            foreach ($donations as $donation) {
                fputcsv($file, [
                    substr($donation->gift_aid_title ?? '', 0, 4), // Max 4 characters
                    substr(str_replace(' ', '', $donation->gift_aid_first_name ?? ''), 0, 35), // Max 35, no spaces
                    substr($donation->gift_aid_last_name ?? '', 0, 35), // Max 35 characters
                    substr($donation->gift_aid_address_line1 ?? '', 0, 40), // Max 40 characters
                    strtoupper($donation->gift_aid_postcode ?? ''), // UPPER CASE with space
                    substr($donation->aggregated_donations ?? '', 0, 35), // Max 35 chars description, DON'T use Yes/No
                    $donation->sponsored_event ? 'Yes' : '', // "Yes" or blank, NOT "No"
                    $donation->created_at->format('d/m/y'), // DD/MM/YY format (2-digit year)
                    number_format($donation->amount, 2, '.', '') // NO £ sign
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
