<!DOCTYPE html>
<html lang="@yield('html_lang', str_replace('_', '-', app()->getLocale()))">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1')">
  <meta name="theme-color" content="#10212a">

  {{-- Core --}}
  <title>@yield('title', 'Case dei Nobili | A five-century collection in Korčula')</title>
  <meta name="description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ asset('sitemap.xml') }}">
  <link rel="alternate" type="text/plain" title="LLMs" href="{{ asset('llms.txt') }}">

  {{-- Favicon --}}
  <link rel="icon" type="image/webp" href="{{ asset('favicon.webp') }}">
  <link rel="alternate icon" type="image/png" href="{{ asset('favicon.png') }}">

  {{-- Open Graph / Facebook --}}
  <meta property="og:site_name" content="Case dei Nobili">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:title" content="@yield('title', 'Case dei Nobili | A five-century collection in Korčula')">
  <meta property="og:description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <meta property="og:image" content="@yield('og_image', asset('images/Korcula_birds_eye_2.webp'))">
  <meta property="og:image:alt" content="@yield('og_image_alt', 'Case dei Nobili historic residences in Korčula')">
  <meta property="og:url" content="@yield('canonical', url()->current())">

  {{-- Twitter Card --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('title', 'Case dei Nobili | A five-century collection in Korčula')">
  <meta name="twitter:description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <meta name="twitter:image" content="@yield('og_image', asset('images/Korcula_birds_eye_2.webp'))">

  {{-- Hreflang (EN primary) --}}
  <link rel="alternate" hreflang="en" href="@yield('canonical', url()->current())">
  <link rel="alternate" hreflang="x-default" href="@yield('canonical', url()->current())">

  {{-- JSON-LD WebSite --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "WebSite",
        "name": "Case dei Nobili",
        "url": "{{ url('/') }}",
        "description": "Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.",
        "inLanguage": "en",
        "publisher": {
          "@id": "{{ url('/') }}#organization"
        }
      },
      {
        "@type": "Organization",
        "@id": "{{ url('/') }}#organization",
        "name": "Case dei Nobili",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/case-dei-nobili-logo.svg') }}",
        "image": "{{ asset('images/Korcula_birds_eye_2.webp') }}",
        "description": "A private collection of restored Gothic and Renaissance residences in Korčula, Croatia.",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Korčula",
          "addressCountry": "HR"
        }
      }
    ]
  }
  </script>

  {{-- Fonts --}}
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}?v={{ filemtime(public_path('css/fonts.css')) }}">

  {{-- Tailwind compiled CSS --}}
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

  {{-- Global styles --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">

  @stack('head')
  @stack('schema')
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>

  {{-- Grain overlay --}}
  <div class="grain" aria-hidden="true"></div>

  {{-- Navigation --}}
  @include('components.navigation')

  {{-- Mobile menu --}}
  @include('components.mobile-menu')

  {{-- Main content --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('components.footer')

  {{-- Global JS --}}
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
  @stack('scripts')
</body>
</html>
