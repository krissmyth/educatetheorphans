# Logo Setup Instructions

To add your logo to the application:

1. **Save your logo image** as `logo.png` in this folder (`public/images/`)
    - Recommended size: At least 400x200 pixels
    - Aspect ratio: 2:1 works well for a logo with text
    - Format: PNG with transparent background

2. The logo will automatically appear in:
    - Dashboard navigation (left side)
    - Public website header (left side of "Educate the Orphans")
    - Browser tab (via favicon)

3. The logo file is referenced in:
    - `resources/views/components/application-logo.blade.php`
    - `resources/views/layouts/navigation.blade.php`
    - `resources/views/layouts/public.blade.php`

4. To also update the favicon (browser tab icon):
    - Replace `public/favicon.ico` with your logo as a favicon
    - Or use an online favicon converter to create `favicon.ico` from your logo

## Current Setup

- Logo path: `public/images/logo.png`
- Navigation text: "Educate the Orphans" (appears next to logo)
- Tab title: "Educate the Orphans" (appears in browser tab)
