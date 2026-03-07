<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaypalController extends Controller
{
    private function getPayPalBaseUrl(): string
    {
        $mode = config('services.paypal.mode', 'sandbox');

        return $mode === 'production'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    private function getPayPalAccessToken(): string
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            throw new \RuntimeException('PayPal credentials are not configured.');
        }

        $response = Http::asForm()
            ->acceptJson()
            ->withBasicAuth($clientId, $clientSecret)
            ->post($this->getPayPalBaseUrl() . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Unable to authenticate with PayPal.');
        }

        $accessToken = $response->json('access_token');

        if (! is_string($accessToken) || $accessToken === '') {
            throw new \RuntimeException('PayPal access token was not returned.');
        }

        return $accessToken;
    }

    private function createRemoteOrder(string $accessToken, Donation $donation, float $amount): string
    {
        $response = Http::acceptJson()
            ->withToken($accessToken)
            ->post($this->getPayPalBaseUrl() . '/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'reference_id' => (string) $donation->id,
                        'custom_id' => (string) $donation->id,
                        'description' => 'Donation to Educate the Orphans',
                        'amount' => [
                            'currency_code' => $donation->currency,
                            'value' => number_format($amount, 2, '.', ''),
                        ],
                    ],
                ],
                'application_context' => [
                    'brand_name' => 'Educate the Orphans',
                    'locale' => 'en-GB',
                    'user_action' => 'PAY_NOW',
                    'shipping_preference' => 'NO_SHIPPING',
                    'return_url' => route('paypal.return'),
                    'cancel_url' => route('paypal.cancel'),
                ],
            ]);

        if (! $response->successful()) {
            $message = $response->json('message')
                ?? $response->json('details.0.description')
                ?? 'Failed to create PayPal order.';

            throw new \RuntimeException($message);
        }

        $orderId = $response->json('id');

        if (! is_string($orderId) || $orderId === '') {
            throw new \RuntimeException('PayPal order ID was not returned.');
        }

        return $orderId;
    }

    /**
     * Create a PayPal order for donation
     */
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'frequency' => 'required|in:one-time,monthly',
            'donor_email' => 'required|email',
            'donor_name' => 'nullable|string',
            'gift_aid' => 'boolean',
            'gift_aid_title' => 'nullable|string|max:4',
            'gift_aid_first_name' => 'nullable|string|max:35',
            'gift_aid_last_name' => 'nullable|string|max:35',
            'gift_aid_address_line1' => 'nullable|string|max:40',
            'gift_aid_address_line2' => 'nullable|string',
            'gift_aid_city' => 'nullable|string',
            'gift_aid_postcode' => 'nullable|string|max:10',
            'aggregated_donations' => 'nullable|string|max:35',
            'sponsored_event' => 'boolean',
        ]);

        try {
            // Create donation record in pending status
            $donation = Donation::create([
                'amount' => $validated['amount'],
                'currency' => config('services.paypal.currency', 'GBP'),
                'frequency' => $validated['frequency'],
                'payment_gateway' => 'paypal',
                'status' => 'pending',
                'donor_email' => $validated['donor_email'],
                'donor_name' => $validated['donor_name'] ?? null,
                'gift_aid_eligible' => $validated['gift_aid'] ?? false,
                'gift_aid_title' => isset($validated['gift_aid_title']) ? substr($validated['gift_aid_title'], 0, 4) : null,
                'gift_aid_first_name' => isset($validated['gift_aid_first_name']) ? substr(str_replace(' ', '', $validated['gift_aid_first_name']), 0, 35) : null,
                'gift_aid_last_name' => isset($validated['gift_aid_last_name']) ? substr($validated['gift_aid_last_name'], 0, 35) : null,
                'gift_aid_address_line1' => isset($validated['gift_aid_address_line1']) ? substr($validated['gift_aid_address_line1'], 0, 40) : null,
                'gift_aid_address_line2' => $validated['gift_aid_address_line2'] ?? null,
                'gift_aid_city' => $validated['gift_aid_city'] ?? null,
                'gift_aid_postcode' => isset($validated['gift_aid_postcode']) ? strtoupper($validated['gift_aid_postcode']) : null,
                'aggregated_donations' => isset($validated['aggregated_donations']) ? substr($validated['aggregated_donations'], 0, 35) : null,
                'sponsored_event' => $validated['sponsored_event'] ?? false,
                'gift_aid_declaration_date' => ($validated['gift_aid'] ?? false) ? now() : null,
            ]);

            $accessToken = $this->getPayPalAccessToken();
            $orderId = $this->createRemoteOrder($accessToken, $donation, (float) $validated['amount']);

            // Store PayPal order ID
            $donation->update([
                'paypal_order_id' => $orderId,
            ]);

            return response()->json([
                'orderId' => $orderId,
                'donationId' => $donation->id,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Capture PayPal payment
     */
    public function captureOrder(Request $request)
    {
        $validated = $request->validate([
            'paypal_order_id' => 'required|string',
        ]);

        try {
            $accessToken = $this->getPayPalAccessToken();
            $response = Http::acceptJson()
                ->withToken($accessToken)
                ->post($this->getPayPalBaseUrl() . '/v2/checkout/orders/' . $validated['paypal_order_id'] . '/capture');

            $result = $response->json();
            $status = data_get($result, 'status');

            if ($status === 'COMPLETED') {
                $donation = Donation::where('paypal_order_id', $validated['paypal_order_id'])->first();
                $transactionId = data_get($result, 'purchase_units.0.payments.captures.0.id');

                if ($donation) {
                    $donation->update([
                        'status' => 'completed',
                        'paypal_transaction_id' => is_string($transactionId) ? $transactionId : null,
                        'completed_at' => now(),
                    ]);

                    return response()->json([
                        'message' => 'Thank you for your donation!',
                        'donation' => $donation,
                    ]);
                }
            }

            if (! $response->successful()) {
                return response()->json([
                    'error' => $response->json('message')
                        ?? $response->json('details.0.description')
                        ?? 'Payment could not be completed'
                ], 400);
            }

            return response()->json([
                'error' => 'Payment could not be completed'
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle successful PayPal payment (redirect from PayPal)
     */
    public function handleReturn(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('donate')->with('error', 'Payment cancelled');
        }

        try {
            $accessToken = $this->getPayPalAccessToken();
            $captureResponse = Http::acceptJson()
                ->withToken($accessToken)
                ->post($this->getPayPalBaseUrl() . '/v2/checkout/orders/' . $token . '/capture');

            $captureResult = $captureResponse->json();
            $captureStatus = data_get($captureResult, 'status');

            if ($captureStatus === 'COMPLETED') {
                $customId = data_get($captureResult, 'purchase_units.0.custom_id');
                $transactionId = data_get($captureResult, 'purchase_units.0.payments.captures.0.id');
                $donation = Donation::find($customId);

                if ($donation) {
                    $donation->update([
                        'status' => 'completed',
                        'paypal_order_id' => $token,
                        'paypal_transaction_id' => is_string($transactionId) ? $transactionId : null,
                        'completed_at' => now(),
                    ]);

                    return redirect()->route('donate')->with('success', 'Thank you for your donation! A receipt has been sent to ' . $donation->donor_email);
                }
            }

            return redirect()->route('donate')->with('error', 'Payment could not be completed');
        } catch (\Throwable $e) {
            return redirect()->route('donate')->with('error', $e->getMessage());
        }
    }

    /**
     * Handle cancelled PayPal payment
     */
    public function handleCancel(Request $request)
    {
        return redirect()->route('donate')->with('error', 'You cancelled the payment. Please try again if you would like to donate.');
    }
}
