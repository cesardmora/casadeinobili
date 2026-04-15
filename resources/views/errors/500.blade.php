<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server Error | Case dei Nobili</title>
  <meta name="description" content="An unexpected error has occurred.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
  <style>html { scroll-behavior: smooth; }</style>
</head>
<body>
  <div class="grain" aria-hidden="true"></div>
  <section class="min-h-screen flex items-center justify-center px-6" style="background: var(--adriatic-deep);">
    <div class="text-center reveal visible">
      <p class="text-xs tracking-widest uppercase mb-8" style="color: var(--patina);">Error 500</p>
      <h1 class="font-display text-7xl md:text-9xl font-light mb-6" style="color: var(--stone-light);">
        A crack in the <em style="color: var(--patina-light);">stone</em>
      </h1>
      <p class="text-lg font-light max-w-md mx-auto mb-12" style="color: var(--stone); opacity: 0.7;">
        Something unexpected happened on our end. Please try again in a moment.
      </p>
      <a href="{{ route('home') }}" class="btn-editorial inline-block">
        Return home
      </a>
    </div>
  </section>
</body>
</html>
