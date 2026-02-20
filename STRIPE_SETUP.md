# Stripe Payment Integration Setup Guide

## Overview

Your donation page is now configured to accept payments directly on-site using Stripe. This guide will help you set up your Stripe account and configure the payment system.

## Features Implemented

✅ On-site payment processing (no redirects)
✅ One-time and monthly recurring donations
✅ Gift Aid declaration and data collection
✅ Secure card payments via Stripe Elements
✅ Lower transaction fees (1.5% + 20p for cards)
✅ Automatic donation tracking in database

## Step 1: Create a Stripe Account

1. Go to https://stripe.com
2. Click "Start now" or "Sign up"
3. Enter your email, create a password
4. Complete the registration process
5. Verify your email address

## Step 2: Get Your API Keys

### Test Mode (for testing)

1. Log in to your Stripe Dashboard: https://dashboard.stripe.com
2. Make sure you're in **Test Mode** (toggle on the left sidebar)
3. Go to **Developers** → **API keys**
4. You'll see two keys:
    - **Publishable key** (starts with `pk_test_`)
    - **Secret key** (starts with `sk_test_`)

### Live Mode (for real donations)

1. Complete Stripe account verification (provide business details, bank account, etc.)
2. Toggle to **Live Mode** in the Stripe Dashboard
3. Go to **Developers** → **API keys**
4. You'll see your live keys:
    - **Publishable key** (starts with `pk_live_`)
    - **Secret key** (starts with `sk_live_`)

## Step 3: Configure Your Environment Variables

Open your `.env` file and update these values:

```env
# For testing
STRIPE_KEY=pk_test_your_publishable_key_here
STRIPE_SECRET=sk_test_your_secret_key_here

# For live donations (after testing)
STRIPE_KEY=pk_live_your_publishable_key_here
STRIPE_SECRET=sk_live_your_secret_key_here

# Webhook secret (optional, for production)
STRIPE_WEBHOOK_SECRET=
```

**Important:** Never commit your `.env` file to version control!

## Step 4: Test the Payment Flow

### Using Test Cards

Stripe provides test card numbers for testing:

| Card Number         | Scenario                |
| ------------------- | ----------------------- |
| 4242 4242 4242 4242 | Successful payment      |
| 4000 0000 0000 0002 | Card declined           |
| 4000 0025 0000 3155 | Requires authentication |

**Test Card Details:**

- Use any future expiry date (e.g., 12/25)
- Use any 3-digit CVC (e.g., 123)
- Use any postcode (e.g., SW1A 1AA)

### Testing Checklist

1. [ ] Visit your donation page: http://educatetheorphans.test/donate
2. [ ] Select a donation amount (e.g., £10)
3. [ ] Choose frequency (Single or Monthly)
4. [ ] Enter your email
5. [ ] Check "Add 25% with Gift Aid" and complete the form
6. [ ] Enter test card: 4242 4242 4242 4242
7. [ ] Click "Donate Now"
8. [ ] Verify success message appears
9. [ ] Check Stripe Dashboard → **Payments** to see the test payment
10. [ ] Check your database `donations` table to see the record

## Step 5: Set Up Webhooks (Optional but Recommended)

Webhooks ensure your database stays in sync with Stripe even if the user closes the page.

1. In Stripe Dashboard, go to **Developers** → **Webhooks**
2. Click **Add endpoint**
3. Enter your webhook URL: `https://yourdomain.com/stripe/webhook`
4. Select events to listen for:
    - `payment_intent.succeeded`
    - `payment_intent.payment_failed`
5. Click **Add endpoint**
6. Copy the **Signing secret** (starts with `whsec_`)
7. Add it to your `.env` file:
    ```env
    STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret_here
    ```

## Step 6: Go Live

Once testing is complete:

1. Complete your Stripe account verification
2. Switch to **Live Mode** in Stripe Dashboard
3. Copy your **live** API keys (pk*live* and sk*live*)
4. Update your `.env` file with live keys
5. Clear your application cache:
    ```bash
    php artisan config:cache
    ```
6. Your donation page is now accepting real payments!

## Transaction Fees

### Card Payments

- **Fee:** 1.5% + 20p per transaction
- **Example:** £10 donation = £0.35 fee → £9.65 to charity

### Direct Debit (Bacs)

- **Fee:** 1% capped at £2
- **Example:** £50/month = £0.50 fee → £49.50 to charity

### Gift Aid

- UK taxpayers can add 25% at no cost to them
- **Example:** £10 donation + Gift Aid = £12.50 total to charity
- You'll need to submit Gift Aid claims to HMRC quarterly/annually

## Gift Aid Management

Gift Aid declarations are stored in the `donations` table with these fields:

- `gift_aid_eligible` (boolean)
- `gift_aid_title`, `gift_aid_first_name`, `gift_aid_last_name`
- `gift_aid_address_line1`, `gift_aid_address_line2`, `gift_aid_city`, `gift_aid_postcode`
- `gift_aid_declaration_date`

### Claiming Gift Aid from HMRC

1. **Export eligible donations:**

    ```php
    $giftAidDonations = Donation::where('gift_aid_eligible', true)
        ->where('status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();
    ```

2. **Submit to HMRC:**
    - Use HMRC's Gift Aid online service: https://www.gov.uk/claim-gift-aid
    - Or use CharityLog: https://www.charitylog.co.uk

3. **Quarterly/Annual Claims:**
    - Most charities claim quarterly
    - Keep records for 6 years

## Database Structure

### Donations Table

All donations are stored in the `donations` table:

```sql
id (auto-increment)
stripe_payment_intent_id (unique identifier from Stripe)
stripe_customer_id (for recurring donors)
amount (in pounds, e.g., 10.00)
currency (GBP)
frequency (one-time or monthly)
payment_method (card or direct_debit)
status (pending, completed, failed, refunded)
donor_email
donor_name
donor_phone
gift_aid_eligible (boolean)
gift_aid_title, gift_aid_first_name, gift_aid_last_name
gift_aid_address_line1, gift_aid_address_line2, gift_aid_city, gift_aid_postcode
gift_aid_declaration_date
metadata (JSON for additional data)
completed_at
created_at, updated_at
```

## Troubleshooting

### "Stripe is not defined" Error

- Make sure you've added your Stripe publishable key to `.env`
- Clear your config cache: `php artisan config:cache`

### Payment Not Processing

- Check browser console for JavaScript errors
- Verify your Stripe secret key is correct
- Check Stripe Dashboard → **Logs** for API errors

### Gift Aid Form Not Appearing

- Make sure you've checked the Gift Aid checkbox
- Clear your browser cache

### Database Not Recording Donations

- Check `/storage/logs/laravel.log` for errors
- Verify database migration ran successfully: `php artisan migrate:status`

## Support Resources

- **Stripe Documentation:** https://stripe.com/docs
- **Stripe Testing:** https://stripe.com/docs/testing
- **Gift Aid Guide:** https://www.gov.uk/donating-to-charity/gift-aid
- **Stripe Support:** support@stripe.com

## Security Notes

⚠️ **Never share your secret key (sk*test* or sk*live*)**
⚠️ **Never commit `.env` to Git**
✅ Only the publishable key (pk\_) is safe to use in frontend code
✅ All payments are processed over HTTPS
✅ Stripe handles PCI compliance for card data

---

Need help? Contact your developer or email Stripe Support.
