# Case dei Nobili — Full Site Audit
> Generated: 2026-04-28 | Laravel 11 · Blade · Tailwind CSS v3 · SQLite
Now let me implement all the quick-win fixes (the ones under 10 minutes) immediately:


---

## 🔴 SECURITY — Fix Immediately

### 1. Dangerous Public PHP Files
`/public` contains executable PHP files accessible by any visitor:
```
public/clear.php
public/fix-db.php
public/fixdb.php
public/reseed.php
public/info.php
public/admin.php
public/update-site.php
```
**Risk:** Any visitor can trigger database resets, seed operations, or view `phpinfo()`.  
**Fix:** Delete all of them. Move any needed functionality behind the authenticated admin panel.

---

### 2. Hardcoded Secret Key Fallback
```php
// routes/web.php line 57
$secretKey = env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!');
```
If `.env` is missing or misconfigured in production, the fallback `'Nobili2026Secure!'` is used.  
**Fix:** Remove the fallback and fail loudly if the key is not set:
```php
$secretKey = config('app.admin_key'); // define via config + env, no fallback
```

---

### 3. Admin Key Exposed in URL Query String
```
/admin/contact-inquiries?key=Nobili2026Secure!
```
The key appears in server access logs, browser history, referrer headers, and any log aggregation tool.  
**Fix:** Only accept the key via POST body (already supported), never via GET query string.

---

### 4. No Rate Limiting on Contact & Newsletter Forms
```php
// routes/web.php
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
```
**Fix:** Add Laravel's `throttle` middleware:
```php
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')  // 5 requests per minute per IP
    ->name('contact.store');
```

---

### 5. Artisan Commands Run Synchronously in HTTP Request
`/admin/system-tools/run` calls `Artisan::call()` synchronously. If a migration runs long, the HTTP request times out mid-migration, leaving the database in a broken state.  
**Fix:** Dispatch to a queue job, or at minimum add a timeout guard and run only safe commands.

---

## 🟠 SEO — High Priority

### 6. Hero H1 is Hidden from Browsers & Screen Readers
```html
<!-- home.blade.php line 88 -->
<h1 class="font-display ... hidden">Case dei Nobili</h1>
<img src=".../case-dei-nobili-logo.svg" alt="Case dei Nobili" ...>
```
The `<h1>` has Tailwind's `hidden` class (`display: none`). Google may flag this as cloaking. Screen readers skip it entirely.  
**Fix:** Remove the `<h1>` and make the SVG `<img>` the visual title. Keep the meaningful `alt` text on the img (already done). Use a visually hidden (not `display:none`) H1 if needed:
```html
<h1 class="sr-only">Case dei Nobili — Heritage Houses of Korčula's Noble Families</h1>
<img src=".../case-dei-nobili-logo.svg" alt="Case dei Nobili" ...>
```

---

### 7. Duplicate JSON-LD Organization Schema
`layouts/app.blade.php` outputs a `WebSite + Organization` `@graph` on every page.  
`pages/home.blade.php` `@push('head')` outputs a second standalone `Organization` block.  
**Fix:** Remove the `@push('head')` JSON-LD block from `home.blade.php`. The layout version is more complete and already correct.

---

### 8. Missing Hreflang for Supported Languages
The site has EN/DE/ES translations in `app.js` (partially implemented). The `<head>` only declares:
```html
<link rel="alternate" hreflang="en" href="...">
<link rel="alternate" hreflang="x-default" href="...">
```
If DE/ES content is ever activated, Google won't know about it.  
**Fix:** Either remove DE/ES from the JS entirely (they're commented out), or add proper hreflang tags and server-side language routing.

---

### 9. Sitemap URL in `<head>` Uses `asset()` Not `route()`
```html
<!-- layouts/app.blade.php line 14 -->
<link rel="sitemap" ... href="{{ asset('sitemap.xml') }}">
```
`asset()` points to `public/sitemap.xml` (static file). The actual sitemap is served dynamically by `route('sitemap')` at `/sitemap.xml`.  
**Fix:**
```html
<link rel="sitemap" type="application/xml" title="Sitemap" href="{{ route('sitemap') }}">
```

---

### 10. Property Pages Use `og:type="article"` Instead of `website`
```php
// properties/show.blade.php
@section('og_type', 'article')
```
A vacation rental is not an `article`. `article` is for blog posts.  
**Fix:** Use `og:type="website"` or the more specific `og:type="product"` which also unlocks rich snippets.

---

### 11. Missing OG Image Dimensions
```html
<meta property="og:image" content="...">
<!-- Missing: -->
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
```
Facebook/LinkedIn scrapers need dimensions to render link previews correctly.

---

### 12. `VacationRental` Schema Missing on Property Pages
`show.blade.php` uses `LodgingBusiness` which is correct but could be more specific. Add `VacationRental` type and key properties:
```json
{
  "@type": ["LodgingBusiness", "VacationRental"],
  "priceRange": "€€€€",
  "amenityFeature": [...],
  "numberOfBedrooms": 3,
  "petsAllowed": false,
  "tourBookingPage": "https://..."
}
```

---

## 🟡 UI/UX Design Issues

### 13. All 4 Testimonials are Identical — Major Credibility Problem
```html
<!-- home.blade.php lines 944–1021 -->
<!-- All 4 cards: same quote, same author "Rizwan M.", same title -->
```
This looks like a placeholder that was never updated. For a luxury brand, fake/repeated testimonials destroy trust.  
**Fix:** Use real, varied testimonials with different guests. If unavailable, use a single testimonial or remove the section.

---

### 14. Testimonial Cards Are White on a Dark Page (Design Clash)
```html
<div class="group bg-white rounded-sm ...">
  <p class="text-gray-600 italic">...</p>
  <p class="text-gray-900">Rizwan M.</p>
```
The rest of the site uses a consistent dark ink/stone/patina palette. These white cards look copy-pasted from a different design system.  
**Fix:** Match the dark theme:
```html
<div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(184,149,107,0.2);">
  <p style="color: var(--stone);">...</p>
  <p style="color: var(--stone-light);">Rizwan M.</p>
```

---

### 15. Phone Number href Doesn't Match Display Text
```html
<!-- home.blade.php lines 1062–1068 -->
<a href="tel:+385996551938">Curator: +34 616 969 596</a>
<a href="tel:+385996551938">Concierge: +385 996 551 938</a>
```
The Curator link displays a Spanish number (`+34`) but the `href` dials a Croatian number (`+385`). Tapping it dials the wrong person.  
**Fix:**
```html
<a href="tel:+34616969596">Curator: +34 616 969 596</a>
<a href="tel:+385996551938">Concierge: +385 996 551 938</a>
```

---

### 16. Footer i18n Key Bug — Both Privacy and Terms Share Key `fv4`
```html
<!-- footer.blade.php lines 52–53 -->
<li><a href="{{ route('privacy') }}" data-i18n="fv4">Privacy</a></li>
<li><a href="{{ route('terms') }}"   data-i18n="fv4">Terms</a></li>
```
Both share the same i18n key. When the language switcher runs, both links get the same translated text (whichever is defined for `fv4`).  
**Fix:** Use distinct keys: `data-i18n="fv4"` for Privacy, `data-i18n="fv5"` for Terms.

---

### 17. Font Sizes Below Accessibility Thresholds
| Element | Size | Approx px |
|---|---|---|
| `.footer-col-title` | `0.52rem` | **8.3 px** |
| `.lang-btn` | `0.55rem` | **8.8 px** |
| `.footer-links a` | `0.73rem` | **11.7 px** |
| `.btn-editorial` | `0.6rem` | **9.6 px** |

WCAG 2.1 recommends a minimum of 12px (0.75rem) for body text. The column titles and language buttons are nearly illegible on mobile.  
**Fix:** Raise minimum to `0.7rem` for secondary text, `0.75rem` for interactive elements.

---

### 18. `data-source-loc` React Attributes in Production HTML
```html
<!-- Testimonial stars in home.blade.php -->
<svg data-source-loc="src/App.tsx:33:2" ...>
```
These are React devtools artifacts copied from another project. They bloat the HTML and leak implementation details.  
**Fix:** Remove all `data-source-loc` attributes.

---

## 🔵 Performance

### 19. Four Separate CSS HTTP Requests on Every Page
```html
<link rel="stylesheet" href="/css/fonts.css?v=...">
<link rel="stylesheet" href="/css/tailwind.css">
<link rel="stylesheet" href="/css/app.css?v=...">
<!-- + appFooter.css loaded inside footer.blade.php -->
```
The `appFooter.css` is included mid-document inside the footer component, not in `<head>` — this can cause a Flash Of Unstyled Content (FOUC) on the footer.  
**Fix:** 
- Move `appFooter.css` link into `layouts/app.blade.php` `<head>`, or
- Bundle all CSS into a single file using a build step.

---

### 20. `app.css` Has ~40% Duplicate/Dead Code (1781 lines → ~900 usable)
The same rule blocks are defined 3–4× with escalating `!important` overrides. Examples:
- `.reveal` defined 4 times (lines 186, 1235, 1286, 1240)
- `#mainNav` defined 5 times (lines 492, 699, 1086, 1124, 1565)
- `.lang-bar` defined 3 times (lines 445, 655, 1081)
- `.lang-btn` defined 3 times
- `.nav-logo` defined 6+ times

This suggests iterative patches stacked on top of each other. The result is unpredictable cascade behavior and ~880 lines of `!important` declarations.  
**Fix:** Consolidate into a single authoritative definition per rule, remove all `!important` flags.

---

### 21. CSS Variables Defined Twice in `:root` (Different Values)
```css
/* app.css lines 7–28 */
:root {
  --stone: #e8e4dd;  /* First definition */
  --ink: #604c30;    /* First definition */
  ...
  --stone: #c8b99a;  /* Second definition — overrides first */
  --ink: #2c251e;    /* Second definition — overrides first */
}
```
The first definitions are dead code but create confusion about the intended values.  
**Fix:** Remove the first set of duplicate declarations.

---

### 22. `rotateGlow` Animation Runs Infinitely Even When Off-Screen
```css
/* app.css */
.private-section::before {
  animation: rotateGlow 30s linear infinite;
}
```
A 200% × 200% pseudo-element rotating indefinitely forces GPU compositing even when the section is not in the viewport. This drains battery on mobile.  
**Fix:** Use `animation-play-state: paused` by default and only play when the element is in view (via `IntersectionObserver` adding a class).

---

### 23. WOFF2 Files Referenced but May Not Exist
```css
/* fonts.css lines 19-21 */
src: url("/fonts/Montserrat/montserrat-300.woff2") format("woff2"),
     url("/fonts/Montserrat/Montserrat-VariableFont_wght.ttf") format("truetype-variations");
```
The comment at the top of `fonts.css` says "Generate these WOFF2 files" — implying they may not exist yet. The browser falls back to the TTF variable font (much larger).  
**Fix:** Generate the WOFF2 files as instructed in the comment, or use Google Fonts CDN with `font-display: swap` (already set ✅).

---

### 24. No `<link rel="preload">` for Hero Image
The LCP element is the hero image. It is loaded via `<x-responsive-image>` which renders an `<img>` tag. Without a `preload` hint, the browser doesn't discover the image until it parses the HTML body.  
**Fix:** Add to `<head>` in `layouts/app.blade.php` (or push from the page):
```html
@stack('preload')
```
And in `home.blade.php`:
```html
@push('preload')
<link rel="preload" as="image" href="{{ asset('images/Korcula_birds_eye_2.webp') }}" fetchpriority="high">
@endpush
```

---

### 25. No Cache Invalidation When Properties Are Updated
```php
// HomeController.php
$properties = cache()->remember('properties_home_collection', 3600, function () {
    return Property::published()->orderBy('sort_order')->get();
});
```
When a property is saved/updated, the cache is not cleared until the 1-hour TTL expires. If you update a property name or image in the admin, the site shows stale data for up to 60 minutes.  
**Fix:** Add a model observer or clear cache on save:
```php
// Property.php
protected static function booted(): void
{
    static::saved(fn() => cache()->forget('properties_home_collection'));
    static::deleted(fn() => cache()->forget('properties_home_collection'));
}
```

---

## ⚪ Laravel / Code Quality

### 26. All Admin Logic Lives in `routes/web.php` as Closures
The admin routes contain 200+ lines of business logic inline in closures. This:
- Cannot be unit tested
- Cannot be cached by Laravel's route caching (`php artisan route:cache` fails with closures)
- Is very hard to maintain

**Fix:** Extract to `App\Http\Controllers\Admin\ContactInquiryController` and `App\Http\Controllers\Admin\SystemToolsController`.

---

### 27. Route Name Defined Twice — Last Definition Wins (Bug)
```php
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');
// ... later:
Route::get('/gracias', [ContactController::class, 'thanks'])->name('contact.thanks');
```
Laravel uses the last registered route for `route('contact.thanks')`. The `/contact/thanks` URL becomes unreachable by name.  
**Fix:** Give each route a unique name: `'contact.thanks'` and `'contact.thanks.es'` (or simply remove the duplicate `/gracias` route).

---

### 28. Duplicate POST Routes for Same Action
```php
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiry', [ContactController::class, 'store'])->name('inquiry.store');
```
Both routes do the same thing. Maintaining two entry points creates confusion and doubles the surface area for bugs/tests.  
**Fix:** Keep only `/contact`. Update any forms pointing to `/inquiry` to use `/contact`.

---

### 29. `env()` Called Directly in Route Closures
```php
// routes/web.php line 57
$secretKey = env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!');
```
Calling `env()` directly (instead of `config()`) means the value is not available after `php artisan config:cache`. Caching config in production (which you have a button for in admin tools!) will break admin access.  
**Fix:** Add to `config/app.php`:
```php
'admin_key' => env('CONTACT_INQUIRIES_KEY'),
```
Then use: `config('app.admin_key')`.

---

### 30. `max-w-12xl` Not Defined in Tailwind Config
```html
<!-- Used throughout blade files -->
<div class="max-w-12xl mx-auto">
```
This class doesn't exist in Tailwind's default scale. It's not in `tailwind.config.js` either. Tailwind's JIT compiler generates it as `max-width: 144rem` (via arbitrary logic), but this is undocumented behavior.  
**Fix:** Either define it explicitly in `tailwind.config.js`:
```js
theme: {
  extend: {
    maxWidth: {
      '12xl': '96rem', // or whatever your intended value is
    }
  }
}
```
Or replace with `max-w-screen-2xl` (1536px) if that's close enough.

---

### 31. `Str::markdown()` on User-Provided Content Without Sanitization
```php
// properties/show.blade.php line 97
{!! Str::markdown($property->long_description ?? '') !!}
```
`{!! !!}` outputs raw HTML. If `long_description` contains JavaScript (e.g. `<script>alert(1)</script>`), it will execute. Although this field is admin-managed (not user-provided), it's a bad habit.  
**Fix:** Use `Str::markdown()` with the `html_input: 'strip'` option, or pass through `strip_tags()` on output.

---

### 32. Airbnb Link on Property `show.blade.php` Will Break If `airbnb_url` Is Null
```php
// properties/show.blade.php line 105
<a href="{{ $property->airbnb_url }}" ...>
```
There is no null check. If `airbnb_url` is null, the href renders as `href=""` pointing to the current page.  
**Fix:** Wrap in `@if($property->airbnb_url)` just like the property card does.

---

## ✅ What's Already Good

| Area | Finding |
|---|---|
| Fonts | `font-display: swap` correctly set on all `@font-face` declarations |
| Images | `responsive-image` component with `srcset` / `sizes` — excellent |
| LCP Image | `loading="eager"` + `fetchpriority="high"` on hero image — correct |
| Accessibility | `prefers-reduced-motion` respected in JS and CSS |
| Scroll Events | All `addEventListener('scroll', ...)` use `{ passive: true }` |
| Cache | Properties cached for 1 hour in controllers — good pattern |
| Admin | Whitelist-only approach for Artisan commands is safe |
| JSON-LD | `WebSite` + `Organization` schema in layout is well-structured |
| CSRF | Meta CSRF token present and used in AJAX calls |
| Robots | `X-Robots-Tag: noindex` on all admin routes |
| `og:` tags | All core OG tags present |
| Canonical | Canonical URL set per-page |
| Sitemap | Dynamic sitemap route exists |
| `robots.txt` | Present in public folder |
| `llms.txt` | Forward-thinking for AI crawlers |

---

## Priority Fix List (Ordered)

| # | Issue | Effort | Impact |
|---|---|---|---|
| 1 | Delete dangerous `public/*.php` files | 2 min | 🔴 Critical |
| 2 | Fix phone number href (Curator) | 1 min | 🟠 High |
| 3 | Add rate limiting to contact/newsletter | 5 min | 🟠 High |
| 4 | Fix `env()` → `config()` in routes | 10 min | 🟠 High |
| 5 | Fix duplicate route name `contact.thanks` | 2 min | 🟠 High |
| 6 | Fix hero `<h1 class="hidden">` → `sr-only` | 2 min | 🟠 High SEO |
| 7 | Fix identical testimonials | 30 min | 🟠 High UX |
| 8 | Fix testimonial card theme clash | 15 min | 🟡 Medium |
| 9 | Fix footer i18n key bug `fv4` | 2 min | 🟡 Medium |
| 10 | Remove `data-source-loc` attributes | 5 min | 🟡 Medium |
| 11 | Fix duplicate JSON-LD on homepage | 5 min | 🟡 Medium SEO |
| 12 | Add OG image dimensions | 5 min | 🟡 Medium SEO |
| 13 | Add model observer for cache invalidation | 20 min | 🟡 Medium |
| 14 | Add `<link rel="preload">` for hero image | 10 min | 🟡 Medium Perf |
| 15 | Fix `sitemap.xml` URL in `<head>` | 2 min | 🟡 Medium SEO |
| 16 | Fix null check on `airbnb_url` | 2 min | 🟡 Medium |
| 17 | Define `max-w-12xl` in tailwind config | 5 min | ⚪ Low |
| 18 | Consolidate/deduplicate `app.css` | 2 hrs | ⚪ Low Tech Debt |
| 19 | Extract admin to Controllers | 3 hrs | ⚪ Low Tech Debt |
| 20 | Remove duplicate `/inquiry` route | 5 min | ⚪ Low |
| 21 | Pause `rotateGlow` when off-screen | 30 min | ⚪ Low Perf |
| 22 | Generate WOFF2 font files | 1 hr | ⚪ Low Perf |
