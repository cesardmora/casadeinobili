<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- Core --}}
  <title>@yield('title', 'Case dei Nobili | A five-century collection in Korčula')</title>
  <meta name="description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

  {{-- Open Graph / Facebook --}}
  <meta property="og:site_name" content="Case dei Nobili">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:title" content="@yield('title', 'Case dei Nobili | A five-century collection in Korčula')">
  <meta property="og:description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <meta property="og:image" content="@yield('og_image', asset('images/og-cover.jpg'))">
  <meta property="og:url" content="@yield('canonical', url()->current())">

  {{-- Twitter Card --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('title', 'Case dei Nobili | A five-century collection in Korčula')">
  <meta name="twitter:description" content="@yield('meta_description', 'Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.')">
  <meta name="twitter:image" content="@yield('og_image', asset('images/og-cover.jpg'))">

  {{-- Hreflang (EN primary) --}}
  <link rel="alternate" hreflang="en" href="@yield('canonical', url()->current())">
  <link rel="alternate" hreflang="x-default" href="@yield('canonical', url()->current())">

  {{-- JSON-LD WebSite --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Case dei Nobili",
    "url": "{{ url('/') }}",
    "description": "Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.",
    "inLanguage": "en"
  }
  </script>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">

  {{-- Tailwind compiled CSS --}}
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

  {{-- Global styles --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">

  @stack('head')
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
  <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
  @stack('scripts')
</body>
</html>
