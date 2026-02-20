<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a payment intent for donation
     */
    public function createPaymentIntent(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:5',
            'frequency' => 'required|in:one-time,monthly',
            'payment_method' => 'required|in:card,direct_debit',
            'donor_email' => 'required|email',
            'donor_name' => 'nullable|string',
            'gift_aid' => 'boolean',
            // Gift Aid fields
            'gift_aid_title' => 'nullable|string',
            'gift_aid_first_name' => 'nullable|string',
            'gift_aid_last_name' => 'nullable|string',
            'gift_aid_address_line1' => 'nullable|string',
            'gift_aid_address_line2' => 'nullable|string',
            'gift_aid_city' => 'nullable|string',
            'gift_aid_postcode' => 'nullable|string',
        ]);

        try {
            // Convert amount to pence (Stripe uses smallest currency unit)
            $amountInPence = (int) ($validated['amount'] * 100);

            // Create or retrieve Stripe customer
            $customer = Customer::create([
                'email' => $validated['donor_email'],
                'name' => $validated['donor_name'] ?? null,
                'metadata' => [
                    'frequency' => $validated['frequency'],
                ],
            ]);

            // Determine payment method types
            $paymentMethodTypes = $validated['payment_method'] === 'direct_debit'
                ? ['bacs_debit']
                : ['card'];

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amountInPence,
                'currency' => 'gbp',
                'customer' => $customer->id,
                'payment_method_types' => $paymentMethodTypes,
                'description' => 'Donation to Educate the Orphans',
                'metadata' => [
                    'frequency' => $validated['frequency'],
                    'gift_aid_eligible' => $validated['gift_aid'] ?? false,
                ],
            ]);

            // Create donation record
            $donation = Donation::create([
                'stripe_payment_intent_id' => $paymentIntent->id,
                'stripe_customer_id' => $customer->id,
                'amount' => $validated['amount'],
                'currency' => 'GBP',
                'frequency' => $validated['frequency'],
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'donor_email' => $validated['donor_email'],
                'donor_name' => $validated['donor_name'] ?? null,
                'gift_aid_eligible' => $validated['gift_aid'] ?? false,
                'gift_aid_title' => $validated['gift_aid_title'] ?? null,
                'gift_aid_first_name' => $validated['gift_aid_first_name'] ?? null,
                'gift_aid_last_name' => $validated['gift_aid_last_name'] ?? null,
                'gift_aid_address_line1' => $validated['gift_aid_address_line1'] ?? null,
                'gift_aid_address_line2' => $validated['gift_aid_address_line2'] ?? null,
                'gift_aid_city' => $validated['gift_aid_city'] ?? null,
                'gift_aid_postcode' => $validated['gift_aid_postcode'] ?? null,
                'gift_aid_declaration_date' => ($validated['gift_aid'] ?? false) ? now() : null,
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'donationId' => $donation->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle successful payment
     */
    public function handleSuccess(Request $request)
    {
        $validated = $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        try {
            $donation = Donation::where('stripe_payment_intent_id', $validated['payment_intent_id'])->first();

            if ($donation) {
                $donation->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                ]);

                return response()->json([
                    'message' => 'Thank you for your donation!',
                    'donation' => $donation,
                ]);
            }

            return response()->json(['error' => 'Donation not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Webhook handler for Stripe events
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );

            // Handle the event
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    $donation = Donation::where('stripe_payment_intent_id', $paymentIntent->id)->first();

                    if ($donation) {
                        $donation->update([
                            'status' => 'completed',
                            'completed_at' => now(),
                        ]);
                    }
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    $donation = Donation::where('stripe_payment_intent_id', $paymentIntent->id)->first();

                    if ($donation) {
                        $donation->update([
                            'status' => 'failed',
                        ]);
                    }
                    break;
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
