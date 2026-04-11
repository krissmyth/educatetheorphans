# PayPal Transaction Declined - Troubleshooting Guide

## What Was Fixed

I've made several improvements to help diagnose and fix the PayPal transaction declined issue:

### 1. **Fixed CSRF Token Handling**

- **Issue**: Routes had CSRF protection disabled but frontend was sending tokens, causing conflicts
- **Fix**: Re-enabled CSRF protection on PayPal routes to match the frontend implementation
- **Files Changed**: `routes/web.php`

### 2. **Added Comprehensive Error Logging**

- **Issue**: Errors weren't being logged, making debugging impossible
- **Fix**: Added detailed logging to all PayPal operations
- **Files Changed**: `app/Http/Controllers/PaypalController.php`
- **Logs Location**: `storage/logs/laravel.log`

### 3. **Improved Frontend Error Handling**

- **Issue**: Generic error messages without details
- **Fix**: Added console logging and more detailed error messages
- **Files Changed**: `resources/views/donate.blade.php`

## How to Check What's Wrong

### Step 1: Check Browser Console

1. Open your website in Chrome/Firefox
2. Press F12 to open Developer Tools
3. Go to the "Console" tab
4. Try making a donation with PayPal
5. Look for red error messages - they will now show detailed information

### Step 2: Check Laravel Logs

```bash
# View the last 50 lines of logs
tail -n 50 storage/logs/laravel.log

# Or on Windows in PowerShell:
Get-Content storage/logs/laravel.log -Tail 50
```

Look for entries like:

- `PayPal authentication failed`
- `PayPal order creation failed`
- `PayPal capture failed`

## Common Issues and Solutions

### Issue 1: Missing or Invalid PayPal Credentials

**Symptoms:**

- Error: "Unable to authenticate with PayPal"
- Status 401 in logs

**Solution:**

1. Check your `.env` file has these set:

```env
PAYPAL_CLIENT_ID=your_actual_client_id_here
PAYPAL_CLIENT_SECRET=your_actual_secret_here
PAYPAL_MODE=sandbox
PAYPAL_CURRENCY=GBP
```

2. Get your credentials:
    - Go to https://developer.paypal.com/dashboard/
    - Click your app name
    - Copy "Client ID" and "Secret"
    - For testing, use **Sandbox** credentials
    - For live, use **Live** credentials

3. Make sure `PAYPAL_MODE` matches your credentials type:
    - `sandbox` = use Sandbox credentials
    - `production` = use Live credentials

4. After updating `.env`, clear the cache:

```bash
php artisan config:clear
php artisan cache:clear
```

### Issue 2: Currency Not Supported by PayPal Account

**Symptoms:**

- Error: "Currency not supported"
- Order creation fails

**Solution:**

1. Check your PayPal account supports GBP
2. If not, change `PAYPAL_CURRENCY` in `.env` to a supported currency (e.g., USD, EUR)
3. Also update `config/services.php` if needed

### Issue 3: Sandbox vs Production Mismatch

**Symptoms:**

- Error: "Invalid client ID"
- Authentication fails

**Solution:**

- If using **Sandbox credentials**, set: `PAYPAL_MODE=sandbox`
- If using **Live credentials**, set: `PAYPAL_MODE=production`
- NEVER mix sandbox credentials with production mode or vice versa

### Issue 4: PayPal Account Issues

**Symptoms:**

- Order creates but payment declines on PayPal side
- "Transaction cannot be processed"

**Solution for Sandbox:**

1. Use PayPal sandbox test accounts, not your real PayPal account
2. Create test buyer account at https://developer.paypal.com/dashboard/accounts
3. Log in to PayPal sandbox with the test buyer account
4. Make sure test account has funds or linked test card

**Solution for Production:**

1. Verify your PayPal business account is fully verified
2. Check account isn't limited or restricted
3. Ensure you can receive payments (may need to confirm email, add bank account, etc.)

### Issue 5: Return URLs Not Configured

**Symptoms:**

- Payment works but doesn't return to your site
- User sees PayPal success but donation isn't recorded

**Solution:**

1. In PayPal dashboard, go to your app settings
2. Add these URLs under "Return URL":
    - Success: `https://yourdomain.com/paypal/return`
    - Cancel: `https://yourdomain.com/paypal/cancel`
3. For local testing: `http://localhost/paypal/return` (but PayPal may not allow localhost)

### Issue 6: Composer Dependencies Not Installed

**Symptoms:**

- Error: "Class not found"
- "PayPal SDK not installed"

**Solution:**

```bash
composer install
# or
composer require paypal/checkout-sdk-php
```

## Testing Checklist

### Before Testing

- [ ] `.env` file has all PayPal credentials set
- [ ] Run `php artisan config:clear`
- [ ] Run `composer install`
- [ ] Database migrations are up to date: `php artisan migrate`

### Test in Sandbox Mode

1. [ ] Set `PAYPAL_MODE=sandbox` in `.env`
2. [ ] Use Sandbox credentials
3. [ ] Create a test buyer account at https://developer.paypal.com/dashboard/accounts
4. [ ] Try making a £5 donation
5. [ ] Check browser console for errors (F12)
6. [ ] Check `storage/logs/laravel.log` for errors
7. [ ] Verify donation appears in admin panel

### Test in Production Mode

1. [ ] Set `PAYPAL_MODE=production` in `.env`
2. [ ] Use Live credentials
3. [ ] Verify your PayPal business account
4. [ ] Test with small amount first (£1-2)
5. [ ] Check everything works before promoting

## Quick Diagnostic Commands

```bash
# Check if PayPal is configured
php artisan tinker
> config('services.paypal')
# Should show: client_id, client_secret, mode, currency

# Check environment variables
php artisan tinker
> env('PAYPAL_CLIENT_ID')
> env('PAYPAL_CLIENT_SECRET')
> env('PAYPAL_MODE')

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Get More Help

If the issue persists:

1. **Check the browser console** (F12 → Console tab) for detailed errors
2. **Check Laravel logs** at `storage/logs/laravel.log`
3. **Test with minimum amount** (£1) to rule out amount issues
4. **Try a different PayPal account** to isolate account-specific problems
5. **Verify your PayPal app status** in the PayPal Developer Dashboard

### Useful Links

- PayPal Developer Dashboard: https://developer.paypal.com/dashboard/
- PayPal API Reference: https://developer.paypal.com/docs/api/orders/v2/
- PayPal Sandbox Accounts: https://developer.paypal.com/dashboard/accounts
- PayPal Support: https://www.paypal.com/en/smarthelp/contact-us

## What to Check Right Now

Run these commands in order and send me the output if you need more help:

```bash
# 1. Check if credentials are set
php artisan tinker
config('services.paypal')
exit

# 2. Try a test donation and check:
# - Browser Console (F12)
# - Laravel logs:
tail -50 storage/logs/laravel.log

# 3. Verify database has PayPal fields:
php artisan tinker
\App\Models\Donation::first()
exit
```

The detailed error messages in the console and logs will tell us exactly what's wrong!
