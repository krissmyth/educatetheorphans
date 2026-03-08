# PayPal "Transaction Declined - International Regulations" Error - FIX

## What This Error Means

The error **"To comply with international regulations, this transaction has been declined"** means:

- ✅ Your code integration is **working correctly**
- ✅ The payment reached PayPal successfully
- ❌ PayPal is **blocking the transaction** due to account restrictions

This is a **PayPal account issue**, not a code problem.

## Quick Fix: Use Sandbox Mode for Testing

The easiest solution for testing is to use PayPal Sandbox, which doesn't have these restrictions:

### Step 1: Get Sandbox Credentials

1. Go to https://developer.paypal.com/dashboard/
2. Log in with your PayPal account
3. Go to **Apps & Credentials**
4. Under **Sandbox**, click **Create App** (or select existing app)
5. Copy your **Sandbox Client ID** and **Sandbox Secret**

### Step 2: Create Sandbox Test Accounts

1. Still in PayPal Developer Dashboard
2. Go to **Sandbox** → **Accounts**
3. You'll see default test accounts for:
    - **Business** (merchant) - receives payments
    - **Personal** (buyer) - makes payments
4. Click on each account and note the email and password
5. Click **View/Edit Account** to see account details

### Step 3: Update Your .env File

```env
PAYPAL_CLIENT_ID=your_sandbox_client_id_here
PAYPAL_CLIENT_SECRET=your_sandbox_secret_here
PAYPAL_MODE=sandbox
PAYPAL_CURRENCY=GBP
```

**IMPORTANT**: Use **Sandbox** credentials, not Live credentials!

### Step 4: Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### Step 5: Test with Sandbox Account

1. Go to your donation page
2. Select PayPal payment option
3. Enter any email (doesn't matter)
4. Click the PayPal button
5. You'll be redirected to **sandbox.paypal.com** (note the "sandbox")
6. **Log in with your Sandbox Personal (buyer) account** credentials
7. Complete the payment
8. ✅ Should work without restrictions!

## For Production/Live Mode

If you need to accept real payments, you need to fix your PayPal business account:

### Option 1: Upgrade to Business Account

1. Log into https://www.paypal.com
2. Go to **Settings** → **Upgrade Account**
3. Select **Business Account**
4. Complete the business verification process

### Option 2: Verify Your Account Fully

Complete these in your PayPal account settings:

#### ✅ Verify Email Address

- Go to **Settings** → **Email**
- Click verify link sent to your email

#### ✅ Add and Confirm Bank Account

- Go to **Settings** → **Bank and Cards**
- Add your bank account
- Verify the micro-deposits

#### ✅ Verify Identity

- Go to **Settings** → **Business Information**
- Upload required documents:
    - Government-issued ID
    - Proof of address
    - Business registration (if applicable)

#### ✅ Enable Payment Receiving

1. Go to **Settings** → **Payment Preferences**
2. Click **Update** next to "Block payments"
3. Make sure these are enabled:
    - ✅ Accept payments in all supported currencies
    - ✅ Allow payments from buyers who don't have a PayPal account
    - ✅ Accept payments denominated in any currency

#### ✅ Set Payment Receiving Preferences

1. Go to **Settings** → **Payment Preferences**
2. Set to **"On"** for receiving payments
3. Unblock any restricted countries if needed

### Option 3: Contact PayPal Support

If you still have issues:

1. Call PayPal Business Support:
    - UK: 0800 358 7911
    - US: 1-888-221-1161
2. Explain you're getting "international regulations" error
3. Ask them to:
    - Check for account limitations
    - Verify your account is approved for receiving payments
    - Remove any restrictions on your account

## Common Account Issues

| Issue                      | Solution                                     |
| -------------------------- | -------------------------------------------- |
| **Personal Account**       | Upgrade to Business Account                  |
| **Unverified Email**       | Verify your email address                    |
| **No Bank Account**        | Add and verify a bank account                |
| **Identity Not Verified**  | Upload ID and proof of address               |
| **Account Limited**        | Contact PayPal support to remove limitations |
| **Country Restrictions**   | Enable all countries in payment preferences  |
| **Currency Not Supported** | Enable all currencies in payment preferences |

## Which Mode Are You Using?

Check your `.env` file:

```bash
# For Testing (Recommended)
PAYPAL_MODE=sandbox  # Uses test accounts, no real money

# For Real Payments
PAYPAL_MODE=production  # Uses your real PayPal account
```

## Testing Checklist

### Sandbox Testing (Recommended First)

- [ ] Using **Sandbox** credentials from developer.paypal.com
- [ ] `.env` has `PAYPAL_MODE=sandbox`
- [ ] Created test buyer account in PayPal Developer Dashboard
- [ ] Logging into **sandbox.paypal.com** (not regular paypal.com)
- [ ] Using test account credentials to complete payment

### Production Testing (After Sandbox Works)

- [ ] PayPal business account is fully verified
- [ ] Email address is confirmed
- [ ] Bank account is added and verified
- [ ] Identity documents uploaded
- [ ] Payment receiving is enabled
- [ ] No account limitations
- [ ] Using **Live** credentials in `.env`
- [ ] `.env` has `PAYPAL_MODE=production`

## Quick Diagnostic

Run this command to check your current mode:

```bash
php artisan tinker
```

Then in tinker:

```php
config('services.paypal.mode')
// Should show: "sandbox" or "production"

config('services.paypal.client_id')
// Should show your client ID (make sure it's not empty)
```

Type `exit` to quit tinker.

## Summary

**For Testing**: Use Sandbox mode with test accounts (no account verification needed)
**For Live**: Fully verify your PayPal business account and enable payment receiving

The error you're seeing is PayPal protecting you and your customers - they want to make sure your account is legitimate before processing real money!
