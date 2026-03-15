<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DonationController extends Controller
{
    /**
     * Get JustGiving charity information
     */
    public function getCampaignData()
    {
        try {
            $charityId = config('services.justgiving.charity_id');
            $apiKey = config('services.justgiving.api_key');

            if (!$apiKey || !$charityId) {
                return response()->json([
                    'error' => 'JustGiving API credentials not configured'
                ], 500);
            }

            // Fetch charity data from JustGiving API
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->get("https://api.justgiving.com/v1/charity/{$charityId}");

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'error' => 'Failed to fetch charity data'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process donation and redirect to JustGiving
     */
    public function redirectToJustGiving(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:2',
            'frequency' => 'required|in:monthly,one-off',
            'giftAid' => 'boolean'
        ]);

        // Build JustGiving donation URL with parameters
        $charityUrl = config('services.justgiving.charity_url');

        $params = [
            'amount' => $validated['amount'],
            'exitUrl' => route('donate') . '?donation_complete=true',
        ];

        $donateUrl = $charityUrl . '?' . http_build_query($params);

        return redirect($donateUrl);
    }

    /**
     * Show the donation page with charity data
     */
    public function show()
    {
        $charitySlug = config('services.justgiving.charity_slug');
        $charityUrl = config('services.justgiving.charity_url');
        $justgivingLinkId = config('services.justgiving.link_id');
        $widgetType = config('services.justgiving.widget_type', 'embed');
        $paypalClientId = config('services.paypal.client_id');

        return view('donate', [
            'charitySlug' => $charitySlug,
            'charityUrl' => $charityUrl,
            'justgivingLinkId' => $justgivingLinkId,
            'widgetType' => $widgetType,
            'justgivingUrl' => $charityUrl,
            'paypalClientId' => $paypalClientId,
        ]);
    }
}
