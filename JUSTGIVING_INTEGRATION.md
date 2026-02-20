# JustGiving Integration Guide

This guide explains how to configure and use the JustGiving integration on your donation page.

## Overview

The donation page now includes a complete JustGiving integration featuring:

- **Interactive Donation Calculator** - Shows impact of different donation amounts
- **JustGiving Widget** - Embedded donation widget for seamless integration
- **Campaign Statistics** - Display of total raised, donors, and campaign target
- **Multiple Payment Methods** - Cards, PayPal, Apple Pay, and more
- **Gift Aid Support** - Enable Gift Aid to boost donations by 25%
- **Monthly Giving** - Support for recurring monthly donations

## Configuration

### 1. Update Environment Variables

Edit your `.env` file and update the JustGiving configuration:

```env
# JustGiving Campaign ID (your JustGiving profile ID)
JUSTGIVING_CAMPAIGN_ID=educatetheorphans

# JustGiving API Key (for fetching campaign data)
JUSTGIVING_API_KEY=your_justgiving_api_key

# JustGiving Charity ID (your registered charity ID)
JUSTGIVING_CHARITY_ID=1234567

# Widget Type (embed or redirect)
JUSTGIVING_WIDGET_TYPE=embed
```

### 2. Get Your JustGiving Credentials

#### Campaign ID

- Log in to your JustGiving account
- Go to your fundraising page
- Your Campaign ID is the URL slug (e.g., `educatetheorphans`)

#### API Key

- Visit https://www.justgiving.com/developer
- Register for developer access
- Create an API application to get your API key

#### Charity ID

- Find your registered charity ID from the JustGiving platform
- This is used to identify your charity in the system

## Features

### Interactive Donation Slider

Users can adjust the amount and see the impact of their donation in real-time. The slider shows:

```
📚 School books
🍎 Meals provided
✏️ Writing materials
🎓 Children supported
```

The breakdown changes based on donation frequency (monthly vs. one-off).

### JustGiving Widget

The embedded JustGiving widget allows users to:

- Donate directly without leaving your website
- Use multiple payment methods
- Set up recurring monthly donations
- Apply Gift Aid (UK taxpayers only)
- Receive email receipts

### Campaign Statistics

The page displays real-time campaign statistics (when API is configured):

```
Total Raised: £X,XXX
Donors: XXX
Target: £X,XXX
```

## API Endpoints

### GET /api/campaign-data

Fetches campaign statistics from JustGiving API.

**Response:**

```json
{
    "amountRaised": 15000,
    "donorCount": 350,
    "targetAmount": 50000,
    "pageTitle": "Educate the Orphans",
    "pageStory": "Help vulnerable children access education..."
}
```

**Requirements:**

- `JUSTGIVING_API_KEY` must be configured
- JustGiving API access enabled on your account

### POST /donate/redirect

Redirects user to JustGiving with donation parameters.

**Parameters:**

- `amount` (required): Donation amount (numeric)
- `frequency` (required): 'monthly' or 'one-off'
- `giftAid` (optional): true/false

## Frontend Implementation

### Donation Modal

When users click "Donate Now" on the slider, a modal appears showing:

- Donation amount
- Donation frequency
- Gift Aid option
- Confirmation button

Clicking "Proceed to Payment" redirects users to JustGiving with their specified amount.

### Campaign Data Loading

The page automatically loads campaign statistics when it loads. If API is not configured, placeholder values are shown.

## Customization

### Change Widget Display

To customize the JustGiving widget, edit the widget embed code in `resources/views/donate.blade.php`:

```html
<script src="https://www.justgiving.com/webapi/widgets/donate?v=2&amp;charityId=CHARITY_ID&amp;ref=website"></script>
```

### Modify Donation Breakdowns

Edit the `updateDonationBreakdown()` function in the donation page JavaScript to customize impact messaging.

## Testing

1. **Local Testing**: The page works in local development without API key
2. **Widget Testing**: The widget will show in development mode
3. **Redirect Testing**: Test the redirect to JustGiving with different amounts

## Troubleshooting

### Widget Not Displaying

- Ensure `JUSTGIVING_CAMPAIGN_ID` is set correctly
- Check browser console for errors
- Verify JustGiving script is loading

### Campaign Data Not Loading

- Check if API key is configured correctly
- Ensure API key has proper permissions
- Check browser network tab for API response errors
- Verify Charity ID is correct

### Redirect Not Working

- Ensure campaign ID is correct in URL
- Check that user is not blocking redirects
- Verify amount parameter is numeric

## Security Considerations

- All payments are processed by JustGiving (PCI compliant)
- No payment data is stored on your server
- SSL/HTTPS is required for production
- API keys should never be exposed in client-side code

## Support

For issues with:

- **JustGiving Integration**: Contact JustGiving Support at https://www.justgiving.com/support
- **Your Website**: Contact your development team

## Resources

- [JustGiving Developer Portal](https://www.justgiving.com/developer)
- [JustGiving API Documentation](https://api.justgiving.com/)
- [JustGiving Widget Guide](https://www.justgiving.com/widgets)
