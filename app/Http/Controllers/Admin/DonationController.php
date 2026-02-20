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
     * Export Gift Aid donations to CSV
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

        $filename = 'gift-aid-donations-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'Donation ID',
                'Date',
                'Title',
                'First Name',
                'Last Name',
                'Email',
                'Donation Amount (£)',
                'Gift Aid Amount (£)',
                'Total (£)',
                'Address Line 1',
                'Address Line 2',
                'City',
                'Postcode',
                'Declaration Date',
                'Frequency',
                'Payment Method'
            ]);

            // Data rows
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->created_at->format('d/m/Y'),
                    $donation->gift_aid_title,
                    $donation->gift_aid_first_name,
                    $donation->gift_aid_last_name,
                    $donation->donor_email,
                    number_format($donation->amount, 2),
                    number_format($donation->gift_aid_amount, 2),
                    number_format($donation->total_with_gift_aid, 2),
                    $donation->gift_aid_address_line1,
                    $donation->gift_aid_address_line2,
                    $donation->gift_aid_city,
                    $donation->gift_aid_postcode,
                    $donation->gift_aid_declaration_date ? $donation->gift_aid_declaration_date->format('d/m/Y') : '',
                    ucfirst($donation->frequency),
                    ucfirst(str_replace('_', ' ', $donation->payment_method))
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
