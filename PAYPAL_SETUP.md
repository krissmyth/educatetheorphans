# PayPal Integration Setup Guide

This guide covers the PayPal integration used on the donations page, alongside JustGiving.

## What's Implemented

- **PayPal Payment Controller** - Handles PayPal order creation, capture, and return/cancel callbacks
- **Donation Flow Integration** - Donation modal supports PayPal and JustGiving options
- **Gift Aid Support** - Gift Aid fields are captured and stored with donation records
- **Admin Visibility** - Donations are tracked in the admin donation list

## Environment Configuration

Add the following to your `.env` file:

```env
# PayPal Configuration
PAYPAL_CLIENT_ID=your_paypal_client_id_here
PAYPAL_CLIENT_SECRET=your_paypal_client_secret_here
PAYPAL_MODE=sandbox
PAYPAL_CURRENCY=GBP
```

## Get PayPal Credentials

1. Open [PayPal Developer Dashboard](https://developer.paypal.com)
2. Create or select an app
3. Copy **Client ID** and **Client Secret**
4. Use sandbox credentials for testing
5. Use live credentials in production

## Return URLs

Configure these in your PayPal app settings:

- Success: `https://yourdomain.com/paypal/return`
- Cancel: `https://yourdomain.com/paypal/cancel`

## User Flow

1. User opens `/donate`
2. User chooses amount and frequency
3. User opens payment modal
4. User selects **PayPal** or **JustGiving**
5. If **PayPal**: user completes payment through PayPal Buttons
6. If **JustGiving**: user is redirected to JustGiving donation page

## Key Files

- `app/Http/Controllers/PaypalController.php`
- `app/Http/Controllers/DonationController.php`
- `routes/web.php`
- `resources/views/donate.blade.php`

## Testing Checklist

1. Set `PAYPAL_MODE=sandbox`
2. Use sandbox buyer account
3. Create and capture PayPal donation
4. Confirm donation record is stored in admin area
5. Test JustGiving redirect path from donation modal

## Troubleshooting

### PayPal button not visible

- Confirm `PAYPAL_CLIENT_ID` exists in `.env`
- Confirm PayPal SDK script loads in browser
- Check browser console for JS errors

### Capture fails

- Confirm mode (sandbox/production) matches your credentials
- Confirm return/cancel URLs are configured
- Check Laravel logs for PayPal API response details

### Donation not recorded

- Confirm migrations are applied
- Confirm PayPal order creation route and capture route are reachable
- Check app logs for validation/API errors

## Security Notes

- Payment details are handled by PayPal/JustGiving, not your server
- App stores payment references only
- Use HTTPS in production
- Keep all API credentials in environment variables only

## References

- [PayPal API Docs](https://developer.paypal.com/docs)
- [PayPal Help](https://www.paypal.com/en/smarthelp/contact-us)
- [JustGiving Developer Portal](https://www.justgiving.com/developer)
