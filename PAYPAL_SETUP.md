# PayPal Integration Setup Guide

This guide covers the PayPal integration that has been added to the donation system alongside the existing Stripe integration.

## What's Been Implemented

- **PayPal Payment Controller** - Handles PayPal order creation, capture, and returns
- **Database Migration** - Adds PayPal-specific fields to donations table
- **Donation Model Updates** - Includes PayPal fields in fillable array
- **Routes** - New routes for PayPal order creation and webhook handling
- **Payment Gateway Toggle** - UI allows users to choose between Stripe and PayPal
- **PayPal Buttons** - Beautiful PayPal payment buttons integrated into checkout modal
- **Full Gift Aid Support** - Works with both payment methods

## Installation Steps

### 1. Install PayPal SDK

Run Composer update to install the PayPal Checkout SDK:

```bash
composer install
```

The `paypal/checkout-sdk-php` package will be installed automatically.

### 2. Environment Configuration

Add the following to your `.env` file:

```env
# PayPal Configuration
PAYPAL_CLIENT_ID=your_paypal_client_id_here
PAYPAL_CLIENT_SECRET=your_paypal_client_secret_here
PAYPAL_MODE=sandbox  # Use 'sandbox' for testing, 'production' for live
PAYPAL_CURRENCY=GBP
```

### 3. Get PayPal Credentials

1. Go to [PayPal Developer Dashboard](https://developer.paypal.com)
2. Create an application or use an existing one
3. Copy your Client ID and Client Secret
4. For Sandbox testing, use sandbox credentials
5. For Production, use live credentials

### 4. Run Database Migration

```bash
php artisan migrate
```

This adds the following fields to the donations table:

- `paypal_order_id`
- `paypal_transaction_id`
- `payment_gateway` (tracks which provider was used)
- `aggregated_donations`
- `sponsored_event`

### 5. Update PayPal Settings

In your PayPal app settings, configure the return URLs:

**Return URL (Success):**

```
https://yourdomain.com/paypal/return
```

**Cancel URL:**

```
https://yourdomain.com/paypal/cancel
```

## How It Works

### User Flow

1. User visits `/donate` page
2. Selects donation amount and frequency
3. Opens payment modal
4. **Selects payment method** - Either "Stripe" or "PayPal"
5. For Stripe: Enters card details and completes payment
6. For PayPal: Clicks PayPal button and completes payment on PayPal's platform
7. Returns to site and sees success message

### Payment Processing

**Stripe Flow:**

- Create payment intent on server
- Confirm payment with Stripe.js
- Webhook validates payment
- Donation marked as completed

**PayPal Flow:**

- Create order on server
- User redirected to PayPal
- User approves payment on PayPal
- Returned to success URL
- Server captures order
- Donation marked as completed

## File Changes Summary

### New Files

- `app/Http/Controllers/PaypalController.php` - PayPal payment handling
- `database/migrations/2026_03_07_000000_add_paypal_fields_to_donations.php` - Database migration

### Modified Files

- `config/services.php` - Added PayPal configuration
- `app/Models/Donation.php` - Updated fillable array with PayPal fields
- `routes/web.php` - Added PayPal routes
- `app/Http/Controllers/DonationController.php` - Pass PayPal client ID to view
- `resources/views/donate.blade.php` - Added PayPal payment option and buttons
- `composer.json` - Added PayPal SDK dependency

## Testing

### Sandbox Testing

1. Use sandbox credentials from PayPal Developer Dashboard
2. Create test buyer and seller accounts
3. Test the full donation flow with different amounts
4. Verify donations appear in your admin panel

### Test Payments

Use PayPal's sandbox test cards:

- **Success:** Use your sandbox buyer account

## Security Notes

- All payment data is transmitted securely
- Stripe uses tokenization - no card data stored on your servers
- PayPal handles all payment processing securely
- Donation records store only payment references, not sensitive data
- Always use HTTPS in production
- Keep API keys secure in environment variables

## Troubleshooting

### PayPal Buttons Not Appearing

- Verify `PAYPAL_CLIENT_ID` is set in `.env`
- Check browser console for JavaScript errors
- Ensure PayPal SDK script is loading: `https://www.paypal.com/sdk/js`

### Payment Fails

- Check PayPal app is in correct mode (sandbox vs production)
- Verify return URLs are configured in PayPal dashboard
- Check donation amount meets minimum (£1)
- View Laravel logs for error details

### Donations Not Recording

- Check database migration ran: `php artisan migrate`
- Verify webhook routes are accessible
- Review donation record in database

## Admin Features

Donations are tracked in `/admin/donations` with filters for:

- Payment gateway (Stripe/PayPal)
- Status (pending/completed/failed)
- Amount and frequency
- Gift Aid eligibility

## Support

For PayPal integration issues:

- [PayPal Documentation](https://developer.paypal.com/docs)
- [PayPal Support](https://www.paypal.com/en/smarthelp/contact-us)

For Stripe issues:

- [Stripe Documentation](https://stripe.com/docs)
- [Stripe Support](https://support.stripe.com)
