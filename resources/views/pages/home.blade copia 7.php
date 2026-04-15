@extends('layouts.app')

@section('title', 'Case dei Nobili | A five-century collection in Korčula')

@section('canonical', url('/'))
@section('og_image', asset('images/Korcula_birds_eye_2.webp'))
@section('og_type', 'website')

@push('head')
{{-- JSON-LD Structured Data --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Case dei Nobili",
  "url": "{{ url('/') }}",
  "description": "Four historic residences on the island of Korčula. Each one, a livable chapter of Dalmatian history.",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Korčula",
    "addressCountry": "HR"
  }
}
</script>
@endpush

@section('content')

  {{-- ===================== HERO 2 ===================== --}}
  <section class="hero-section">
    {{-- <div class="hero-bg"></div> --}}
    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    {{-- Decorative coat of arms --}}
    <!-- <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none" aria-hidden="true">
        <img
            src="{{ asset('images/coat-of-arms.png') }}"
            alt=""
            style="width: 189px; height: 189px; opacity: 0.05; filter: invert(1); object-fit: contain;"
        >
    </div> -->

    {{-- Decorative coat of arms --}}
    <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none" aria-hidden="true">
        <img
            src="{{ asset('images/coat-of-arms.png') }}"
            alt=""
            style="width: 189px !important; height: 189px !important; max-width: 189px !important; opacity: 0.05; filter: invert(1); object-fit: contain; display: block; flex-shrink: 0;"
        >
    </div>

    <img
      src="{{ asset('images/Korcula_birds_eye_2.webp') }}"
      alt="Case dei Nobili"
      class="hero-img-desktop"
    >

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
    {{-- <div class="relative z-10 h-full flex flex-col justify-start items-center px-6 lg:px-12 mt-16 pt-50"> --}}
      <div class="max-w-7xl mx-auto w-full text-center">
        {{-- <div class="max-w-12xl">
          <p class="text-xs tracking-widest uppercase mb-8 opacity-60" style="color: var(--stone);"
            data-i18n="hero_location">Korčula, Croatia</p>
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8"
              style="color: var(--stone-light);">
            <span data-i18n="">Case dei</span>
            <em class="font-normal" style="color: var(--patina-light);"
                data-i18n="">Nobili</em>
          </h1>
          <p class="text-lg md:text-xl font-light leading-relaxed mb-12 max-w-2xl"
            style="color: var(--stone)"
            data-i18n="hero_subtitle">
            Four historic residences on the island of Korčula.<br> Each one, a livable chapter of Dalmatian history.
          </p>
        </div> --}}

        <div class="max-w-12xl">
          <p class="text-xs tracking-widest uppercase mb-8 opacity-60" style="color: var(--stone);"
            data-i18n="hero_location">Korčula, Croatia</p>
          
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8"
              style="color: var(--stone-light);">
            <span data-i18n="">Case dei</span>
            <em class="font-normal" style="color: var(--patina-light);"
                data-i18n="">Nobili</em>
          </h1>
          
          <p class="text-lg md:text-xl font-light leading-relaxed mb-12 max-w-2xl mx-auto whitespace-pre-line"
            style="color: var(--stone)"
            data-i18n="hero_subtitle">
            Four historic residences on the island of Korčula.
            Each one, a livable chapter of Dalmatian history.
          </p>
          
          {{-- <a href="#collection" class="btn-editorial inline-block" data-i18n="hero_cta">
            Explore the collection
          </a> --}}
        </div>
        {{-- Hero CTA buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">

          <a href="#collection"
            class="inline-block px-10 py-4 text-xs tracking-widest uppercase border transition-colors duration-300 bg-[var(--stone-bg)] hover:bg-[var(--stone-hover-bg)]"
            style="border-color: rgba(184,149,107,0.5); color: var(--stone-light);"
            data-i18n="hero_cta1">
            Explore the Collection
          </a>
        
          <a href="#weddings"
            class="inline-block px-10 py-4 text-xs tracking-widest uppercase border transition-colors duration-300 bg-[var(--stone-bg)] hover:bg-[var(--stone-hover-bg)]"
            style="border-color: rgba(184,149,107,0.5); color: var(--stone-light);"
            data-i18n="hero_cta2">
            Weddings & Events
          </a>
        
        </div>
      </div>
    </div>

    <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10">
      <div class="flex flex-col items-center gap-4 opacity-50">
        <span class="text-xs tracking-widest uppercase" style="color: var(--stone);"
              data-i18n="hero_scroll">Discover</span>
        <div class="w-px h-16 relative overflow-hidden" style="background: rgba(245,242,237,0.3);">
          <div class="absolute top-0 left-0 w-full h-1/2 animate-pulse" style="background: var(--patina);"></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== HISTORY / PHILOSOPHY ===================== --}}
  {{-- <section id="nosotrosOK" class="py-24 lg:py-40 px-6 lg:px-12 relative overflow-hidden">

    <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block" aria-hidden="true">
      <div class="chapter-number absolute top-1/2 right-12 transform -translate-y-1/2">V</div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">

        <div class="reveal order-2 lg:order-1">
          <div class="relative aspect-[4/5]">
            <img
               src="{{ asset('images/korcula_CityEntry.webp') }}"
              alt="Architectural limestone detail"
              class="w-full h-full object-cover"
              loading="lazy"
            >
            <div class="absolute bottom-0 left-0 right-0 p-8" style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
              <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">Korčula Limestone</p>
              <p class="font-display text-lg mt-1" style="color: var(--stone-light);">
                Quarried from the island for over five centuries
              </p>
            </div>
          </div>
        </div>

      <div class="flex flex-col justify-center order-1 lg:order-2">
        <div class="reveal">
          <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--stone);"
            data-i18n="about_eyebrow">Our Philosophy</p>
          <h2 class="font-display text-4xl md:text-5xl font-light leading-tight mb-8" style="color: var(--stone);">
            <span data-i18n="about_title_1">CASE DEI </span><br>
            <em class="italic" style="color: var(--stone-light);"
                data-i18n="about_title_2">NOBILI</em>
          </h2>
        </div>

        <div class="reveal reveal-delay-2">
          <div class="w-24 h-px mb-8" style="background: var(--patina);"></div>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-6" style="color: var(--stone);"
            data-i18n="about_text1">
            Within the medieval walls of Korčula, Case dei Nobili is a curated collection of Gothic and Renaissance residences once belonging to the island’s noble families. Carefully restored with respect for their architectural heritage, each house preserves the spirit of centuries past—stone arches, vaulted ceilings, and noble proportions—while offering the comfort and refinement of contemporary living.</p>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-8" style="color: var(--stone);"
            data-i18n="about_text2">
            Just steps from the Cathedral and the quiet rhythm of Korčula’s old town, these residences invite guests to experience the Adriatic not as visitors, but as temporary residents of its history.
            
            Case dei Nobili is not a hotel collection, but a curated ensemble of historic homes for those who value authenticity, heritage, and a rare sense of place.</p>
        </div>

        <div class="reveal reveal-delay-3 grid grid-cols-3 gap-8 mt-8">
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--stone-light);">{{ $stats['properties'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--stone);"
              data-i18n="stat_properties">Properties</p>
          </div>
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--stone-light);">{{ $stats['centuries'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--stone);"
              data-i18n="stat_centuries">Centuries</p>
          </div>
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--stone-light);">{{ $stats['island'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--stone);"
              data-i18n="stat_island">Island</p>
          </div>
        </div>
          <div class="mt-16 reveal reveal-delay-4 visible">
            <a href="{{ route('about') }}" class="btn-editorial-2 inline-block" data-i18n="nav_about">About Us</a>
          </div>
      </div>

      </div>
    </div>
  </section> --}}


  {{-- ===================== INTRO / OUR STORY ===================== --}}
  <section id="about" class="py-24 lg:py-40 px-6 lg:px-12 relative overflow-hidden" style="background: var(--ink);">

    {{-- Decorative chapter number --}}
    <!-- <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block" aria-hidden="true">
      <div class="chapter-number absolute top-1/2 right-12 transform -translate-y-1/2">XIV</div>
    </div> -->

    {{-- Decorative coat of arms --}}
    {{-- <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block" aria-hidden="true">
        <div class="absolute top-1/2 right-12 transform -translate-y-1/2">
            <img src="{{ asset('images/coat-of-arms.png') }}" alt="" class="w-64 h-64 object-contain opacity-15 invert">
        </div>
    </div> --}}

    <div class="max-w-12xl mx-auto relative z-10">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

        {{-- Left: image --}}
        <div class="reveal order-2 lg:order-1">
          <div class="relative aspect-[4/5] overflow-hidden group cursor-pointer">
            <img
              src="{{ asset('images/korcula_CityEntry.webp') }}"
              alt="Korčula old town"
              class="w-full h-full object-cover group-hover:scale-110"
              style="transition: transform 2s ease-out;"
              loading="lazy"
            >
            <div class="absolute bottom-0 left-0 right-0 p-8"
                style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
              <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">Korčula, Croatia</p>
              <p class="font-display text-lg mt-1" style="color: var(--stone-light);">
                Where history becomes home
              </p>
            </div>
          </div>
        </div>

        {{-- Right: content --}}
        <div class="flex flex-col justify-center order-1 lg:order-2">

          <div class="reveal">
            <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--stone);"
              data-i18n="about_eyebrow">Our Philosophy</p>
            <h2 class="font-display text-4xl md:text-5xl font-light leading-tight mb-8" style="color: var(--stone);">
              <span data-i18n="about_title_1">CASE DEI </span><br>
              <em class="italic" style="color: var(--stone-light);"
                  data-i18n="about_title_2">NOBILI</em>
            </h2>
          </div>

          <div class="reveal reveal-delay-2">
            <div class="w-24 h-px mb-8" style="background: var(--patina);"></div>
            <p class="text-base lg:text-lg font-light leading-relaxed mb-6" style="color: var(--stone);"
              data-i18n="about_text1">
              Within the medieval walls of Korčula, Case dei Nobili is a curated collection of Gothic and Renaissance residences once belonging to the island’s noble families. Carefully restored with respect for their architectural heritage, each house preserves the spirit of centuries past—stone arches, vaulted ceilings, and noble proportions—while offering the comfort and refinement of contemporary living.</p>
            <p class="text-base lg:text-lg font-light leading-relaxed mb-8" style="color: var(--stone);"
              data-i18n="about_text2">
              Just steps from the Cathedral and the quiet rhythm of Korčula’s old town, these residences invite guests to experience the Adriatic not as visitors, but as temporary residents of its history.
              Case dei Nobili is not a hotel collection, but a curated ensemble of historic homes for those who value authenticity, heritage, and a rare sense of place.</p>
          </div>

          {{-- Airbnb banner --}}
          <div class="reveal reveal-delay-3">
            <a href="https://www.airbnb.de/rooms/1138104029716036612" target="_blank" rel="noopener"
              class="airbnb-banner inline-flex items-center gap-3 mb-10">
              <div class="airbnb-dot"></div>
              <span class="text-sm font-light" style="color: var(--stone);"
                    data-i18n="intro_airbnb">
                Now available on Airbnb — The XIV Century Duplex
              </span>
            </a>
          </div>

          {{-- Stats grid --}}
          <div class="reveal reveal-delay-3 grid grid-cols-2 md:grid-cols-4 gap-6 mb-10 pt-8 border-t"
              style="border-color: rgba(184,149,107,0.2);">
            <div class="text-center">
              <p class="font-display text-3xl lg:text-4xl font-light mb-1" style="color: var(--patina);">XIV</p>
              <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.7;"
                data-i18n="stat1">Century · Oldest property</p>
            </div>
            <div class="text-center">
              <p class="font-display text-3xl lg:text-4xl font-light mb-1" style="color: var(--patina);">4</p>
              <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.7;"
                data-i18n="stat2">Noble Residences</p>
            </div>
            <div class="text-center">
              <p class="font-display text-3xl lg:text-4xl font-light mb-1" style="color: var(--patina);">130+</p>
              <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.7;"
                data-i18n="stat3">m² · Gothic Palace</p>
            </div>
            <div class="text-center">
              <p class="font-display text-3xl lg:text-4xl font-light mb-1" style="color: var(--patina);">40m</p>
              <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.7;"
                data-i18n="stat4">To the sea · KPK House</p>
            </div>
          </div>

          {{-- CTA --}}
          {{-- <div class="reveal reveal-delay-4">
            <a href="{{ route('about') }}" class="btn-editorial-2 inline-block" data-i18n="nav_about">About Us</a>
          </div> --}}

          <a href="{{ route('about') }}" 
            class="btn-editorial inline-block"
            data-i18n="hero_cta1">
            About us
          </a>

        </div>
      </div>
    </div>
  </section>

  {{-- ===================== COLLECTION ===================== --}}
  <section id="collection" class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--dark);">
    <div class="max-w-7xl mx-auto">

      {{-- Section header --}}
      <div class="mb-16 lg:mb-20 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--stone);">The Properties</p>
        <div class="flex items-end justify-between gap-8">
          <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--stone);">
            Four <em>extraordinary</em><br>residences</h2>
          </h2>
          <div class="hidden md:block w-32 h-px" style="background: var(--stone-light);"></div>
        </div>
      </div>

      {{-- Properties grid --}}
      <div class="grid md:grid-cols-2 gap-4 lg:gap-6">
        @foreach($properties as $property)
          @include('components.property-card', ['property' => $property])
        @endforeach
      </div>

    </div>
  </section>

  {{-- ===================== WEDDINGS ===================== --}}
  {{-- <section id="bodasOk" class="private-section py-24 lg:py-40 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto relative z-10">

      <div class="text-center mb-16 reveal">
        <div class="inline-flex items-center gap-3 px-5 py-2 border mb-8" style="border-color: rgba(184,149,107,0.3); border-radius: 2px;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span class="text-xs tracking-widest uppercase" style="color: var(--patina);">Private Access</span>
        </div>
        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-6" style="color: var(--stone-light);">
          Weddings at Case dei Nobili
        </h2>
        <p class="text-base lg:text-lg font-light max-w-2xl mx-auto" style="color: var(--stone); opacity: 0.7;">
          Exclusive for wedding planners and luxury agencies
        </p>
      </div>

      <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">

        <div class="reveal reveal-delay-1 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(13,31,40,0.3);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Unique Spaces</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Medieval courtyards, terraces with Adriatic views, and historic halls for intimate celebrations or exclusive events for up to 80 guests.
          </p>
        </div>

        <div class="reveal reveal-delay-2 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(13,31,40,0.3);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Integrated Accommodation</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Accommodation for the bridal family in our historic properties. Every room tells a story, every sunrise is a promise.
          </p>
        </div>

        <div class="reveal reveal-delay-3 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(13,31,40,0.3);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Partner Network</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Access to our curation of local vendors: private chefs, florists, photographers, and musicians who know every corner of our houses.
          </p>
        </div>

      </div>

      <div class="text-center mt-16 reveal reveal-delay-4">
        <p class="text-sm font-light mb-8 max-w-lg mx-auto" style="color: var(--stone); opacity: 0.6;">
          Request access to our exclusive dossier for professionals. Response within 48 hours.
        </p>
        <a href="#contact" class="btn-editorial inline-block">Request Dossier</a>
      </div>

    </div>
  </section> --}}

  <section id="weddings" class="py-24 lg:py-40 px-6 lg:px-12 relative overflow-hidden" style="background: var(--adriatic-deep);">

    {{-- Decorative chapter number --}}
    <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block" aria-hidden="true">
      <div class="chapter-number absolute top-1/2 right-12 transform -translate-y-1/2">W</div>
    </div>
  
    <div class="max-w-12xl mx-auto relative z-10">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
  
        {{-- Left: 3 stacked images --}}
        <div class="reveal order-2 lg:order-1">
          <div class="grid grid-cols-1 gap-3">
  
            {{-- Image 1 — tall, spans 2 rows --}}
            <div class="relative aspect-[4/5] overflow-hidden group cursor-pointer">
              <img
                src="{{ asset('images/Sant_Markus_Sq.webp') }}"
                alt="Wedding ceremony"
                class="w-full h-full object-cover group-hover:scale-110"
                style="transition: transform 2s ease-out;"
                loading="lazy"
              >
              <div class="absolute bottom-0 left-0 right-0 p-6"
                   style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
                <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">The Ceremony</p>
              </div>
            </div>
  
            {{-- Image 2 --}}
            {{-- <div class="relative overflow-hidden" style="height: 252px;">
              <img
                src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&q=80"
                alt="Wedding celebration"
                class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                loading="lazy"
              >
              <div class="absolute bottom-0 left-0 right-0 p-4"
                   style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
                <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">The Celebration</p>
              </div>
            </div> --}}
  
            {{-- Image 3 --}}
            {{-- <div class="relative overflow-hidden" style="height: 252px;">
              <img
                src="https://images.unsplash.com/photo-1510076857177-7470076d4098?w=800&q=80"
                alt="Wedding setting"
                class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                loading="lazy"
              >
              <div class="absolute bottom-0 left-0 right-0 p-4"
                   style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
                <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">The Island</p>
              </div>
            </div> --}}
  
          </div>
        </div>
  
        {{-- Right: text content --}}
        <div class="flex flex-col justify-center order-1 lg:order-2">
  
          <div class="reveal">
            <div class="inline-flex items-center gap-3 px-5 py-2 border mb-8"
                 style="border-color: rgba(184,149,107,0.3); border-radius: 2px;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <span class="text-xs tracking-widest uppercase" style="color: var(--patina);"
                    data-i18n="wed_eyebrow">Weddings & Celebrations</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl font-light leading-tight mb-8"
                style="color: var(--stone-light);"
                data-i18n="wed_title">
              A setting for<br>
              <em style="color: var(--patina-light);">unforgettable vows</em>
            </h2>
          </div>
  
          <div class="reveal reveal-delay-2">
            <div class="w-24 h-px mb-8" style="background: var(--patina);"></div>
            <p class="text-base lg:text-lg font-light leading-relaxed mb-10"
               style="color: var(--stone); opacity: 0.8;"
               data-i18n="wed_text">
              The medieval walls of Korčula, the shimmer of the Adriatic, a candlelit Gothic palace — some ceremonies deserve a setting no hotel ballroom can offer. Case dei Nobili is available exclusively for intimate weddings, anniversaries and private celebrations.
            </p>
          </div>
  
          {{-- Features --}}
          <div class="reveal reveal-delay-3 space-y-6 mb-10">
  
            <div class="flex items-start gap-4">
              <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center border mt-1"
                   style="border-color: var(--patina);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color: var(--patina);">
                  <path d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.18L12 21z"/>
                </svg>
              </div>
              <div>
                <p class="text-sm font-light tracking-wide mb-1" style="color: var(--stone-light);"
                   data-i18n="wf1_title">Exclusive Property Hire</p>
                <p class="text-sm font-light" style="color: var(--stone); opacity: 0.6;"
                   data-i18n="wf1_desc">The entire property — and its history — is yours alone.</p>
              </div>
            </div>
  
            <div class="flex items-start gap-4">
              <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center border mt-1"
                   style="border-color: var(--patina);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: var(--patina);">
                  <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                </svg>
              </div>
              <div>
                <p class="text-sm font-light tracking-wide mb-1" style="color: var(--stone-light);"
                   data-i18n="wf2_title">Curated Local Vendors</p>
                <p class="text-sm font-light" style="color: var(--stone); opacity: 0.6;"
                   data-i18n="wf2_desc">Exclusive access to our network of caterers, florists, musicians and Dalmatian officiants.</p>
              </div>
            </div>
  
            <div class="flex items-start gap-4">
              <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center border mt-1"
                   style="border-color: var(--patina);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: var(--patina);">
                  <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
                </svg>
              </div>
              <div>
                <p class="text-sm font-light tracking-wide mb-1" style="color: var(--stone-light);"
                   data-i18n="wf3_title">Multi-Day Celebrations</p>
                <p class="text-sm font-light" style="color: var(--stone); opacity: 0.6;"
                   data-i18n="wf3_desc">From intimate rehearsal dinners to the reception and farewell brunch across multiple properties.</p>
              </div>
            </div>
  
          </div>
  
          {{-- CTA --}}
          <div class="reveal reveal-delay-4">
            <a href="mailto:case.dei.nobili@vongriesheim.com?subject=Wedding%20Enquiry"
               class="btn-editorial inline-block"
               data-i18n="wed_btn">Wedding Enquiry</a>
          </div>
  
        </div>
  
      </div>
    </div>
  </section>
  {{-- ===================== ISLA KORČULA ===================== --}}
  {{-- <section id="island" class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--ink);">
    <div class="max-w-7xl mx-auto">

      <div class="text-center mb-16 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);"
           data-i18n="isl_eyebrow">The Setting</p>
        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-6"
            style="color: var(--stone-light);">
          <span data-i18n="isl_title">Korčula — <em style="color: var(--patina-light);">the island refined<br>by time</em></span>
        </h2>
      </div>

      <div class="grid lg:grid-cols-3 gap-8 lg:gap-12 mb-20">

       
        <div class="reveal reveal-delay-1 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.03);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
              <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);"
              data-i18n="isl1_title">History & Heritage</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl1_text">
            The birthplace of Marco Polo. Centuries of Venetian, Byzantine, and Dalmatian culture carved into every stone.
          </p>
        </div>

        
        <div class="reveal reveal-delay-2 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.03);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
              <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
              <line x1="6" y1="1" x2="6" y2="4"></line>
              <line x1="10" y1="1" x2="10" y2="4"></line>
              <line x1="14" y1="1" x2="14" y2="4"></line>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);"
              data-i18n="isl2_title">Gastronomy & Wine</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl2_text">
            Pošip white wine, Grk, fresh seafood. Korčula is one of Croatia's finest gastronomic destinations.
          </p>
        </div>

        
        <div class="reveal reveal-delay-3 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.03);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);"
              data-i18n="isl3_title">Sailing & The Sea</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl3_text">
            Crystal-clear waters, hidden coves, and direct connections to Hvar, Dubrovnik, and the Dalmatian archipelago.
          </p>
        </div>

      </div>

      
      <div class="reveal overflow-hidden w-full" style="height: 300px;">
        <img
          src="{{ asset('images/korcula_02.webp') }}"
          alt="Korčula"
          class="w-full h-full object-cover"
          loading="lazy"
          style="filter: brightness(0.7);"
        >
      </div>

    </div>
  </section> --}}

  {{-- ===================== ISLA 2 — PANELS ===================== --}}
  <section id="island" class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--adriatic);">
    <div class="max-w-12xl mx-auto">

      {{-- Header --}}
      <div class="text-center mb-16 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);"
           data-i18n="isl_eyebrow">The Setting</p>
        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-6"
            style="color: var(--stone-light);">
          <span data-i18n="isl_title">Korčula — <em style="color: var(--patina-light);">the island<br>refined by time</em></span>
        </h2>
      </div>

      {{-- Panels grid --}}
      <div class="grid md:grid-cols-3 gap-0 reveal">

        {{-- Panel 1 — History --}}
        <div class="relative overflow-hidden group cursor-pointer" style="height: 520px;">
          <div class="absolute inset-0 group-hover:scale-110"
               style="background-image: url('https://images.unsplash.com/photo-1555990793-da11153b2473?w=900&q=80'); background-size: cover; background-position: center; transition: transform 2s ease-out;"></div>
          <div class="absolute inset-0" style="background-color: rgba(0,0,0,0.4); transition: background-color 2s ease;"></div>
          <div class="absolute inset-0 flex flex-col justify-end p-8 lg:p-10">
            <div class="text-3xl mb-4">⚓</div>
            <h3 class="font-display text-2xl font-light mb-3" style="color: var(--stone-light);"
                data-i18n="isl1_title">History & Culture</h3>
            <div class="w-8 h-px mb-4" style="background: var(--patina);"></div>
            <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.8;"
               data-i18n="isl1_text">
               Korčula is often described as one of the most beautiful historic towns on the Adriatic. Rising from the sea on a small peninsula, the old town is a compact medieval settlement built almost entirely from local limestone. Its towers, walls and narrow streets reflect centuries of Venetian influence and maritime trade.
            </p>
          </div>
        </div>

        {{-- Panel 2 — Gastronomy --}}
        <div class="relative overflow-hidden group cursor-pointer" style="height: 520px;">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110"
               style="background-image: url('https://images.unsplash.com/photo-1546484396-fb3fc6f95f98?w=900&q=80'); transition: transform 2s ease-out;"></div>
          <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20" style="transition: background-color 2s ease;"></div>
          <div class="absolute inset-0 flex flex-col justify-end p-8 lg:p-10">
            <div class="text-3xl mb-4">🍷</div>
            <h3 class="font-display text-2xl font-light mb-3" style="color: var(--stone-light);"
                data-i18n="isl2_title">Gastronomy & Wine</h3>
            <div class="w-8 h-px mb-4" style="background: var(--patina);"></div>
            <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.8;"
               data-i18n="isl2_text">
              Pošip white wine, Grk, fresh seafood. Korčula is one of Croatia's finest gastronomic destinations.
            </p>
          </div>
        </div>

        {{-- Panel 3 — Sailing --}}
        <div class="relative overflow-hidden group cursor-pointer" style="height: 520px;">
          <div class="absolute inset-0 bg-cover bg-center group-hover:scale-110"
               style="background-image: url('https://images.unsplash.com/photo-1505118380757-91f5f5632de0?w=900&q=80'); transition: transform 2s ease-out;"></div>
          <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20" style="transition: background-color 2s ease;"></div>
          <div class="absolute inset-0 flex flex-col justify-end p-8 lg:p-10">
            <div class="text-3xl mb-4">⛵</div>
            <h3 class="font-display text-2xl font-light mb-3" style="color: var(--stone-light);"
                data-i18n="isl3_title">Sailing & The Sea</h3>
            <div class="w-8 h-px mb-4" style="background: var(--patina);"></div>
            <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.8;"
               data-i18n="isl3_text">
              Crystal-clear waters, hidden coves, and direct connections to Hvar, Dubrovnik and the Dalmatian archipelago.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SIMPLE CONTACT -->
  <section id="contact" class="py-32 lg:py-40 px-6 lg:px-12" style="background: var(--ink);">
    <div class="max-w-3xl mx-auto text-center reveal">
 
      {{-- Eyebrow --}}
      <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);"
         data-i18n="contact_eyebrow">Contact</p>
 
      {{-- Title --}}
      <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-8" style="color: var(--stone-light);"
          data-i18n="contact_title">
        Bookings & <em style="color: var(--patina-light);">Enquiries</em>
      </h2>
 
      {{-- Divider --}}
      <div class="w-16 h-px mx-auto mb-10" style="background: var(--patina);"></div>
 
      {{-- Text --}}
      <p class="text-base lg:text-lg font-light leading-relaxed mb-10 max-w-xl mx-auto"
         style="color: var(--stone); opacity: 0.7;"
         data-i18n="contact_text">
        For bookings, availability enquiries, or information about weddings and private events, contact us directly.
      </p>
 
      {{-- Email --}}
      <a href="mailto:case.dei.nobili@vongriesheim.com"
         class="inline-block font-display text-xl md:text-2xl font-light hover:underline mb-4"
         style="color: var(--stone-light);">
        case.dei.nobili@vongriesheim.com
      </a>
 
      {{-- Phone --}}
      <p class="text-sm font-light mb-4">
        <a href="tel:+385996551938" class="hover:underline" style="color: var(--stone); opacity: 0.7;">
          Concierge: +385 996 551 938
        </a>
      </p>
 
      {{-- Note --}}
      <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--patina); opacity: 0.6;"
         data-i18n="contact_note">Korčula, Croatia</p>
 
      {{-- Newsletter --}}
      {{-- <div class="mt-16 pt-16 border-t reveal reveal-delay-2" style="border-color: rgba(184,149,107,0.15);">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Newsletter</p>
        <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">
          Stories from the island
        </h3>
        <p class="text-sm font-light mb-8" style="color: var(--stone); opacity: 0.6;">
          Chronicles from Korčula, collection updates and exclusive offers — before anyone else.
        </p>
 
        @if(session('newsletter_success'))
          <p class="text-sm mb-4" style="color: var(--patina-light);">{{ session('newsletter_success') }}</p>
        @endif
 
        <form id="newsletterForm"
              action="{{ route('newsletter.store') }}"
              method="POST"
              class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
          @csrf
          <input
            type="email"
            name="email"
            placeholder="Your email"
            required
            class="flex-1 px-6 py-4 text-sm font-light border focus:outline-none"
            style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
            aria-label="Email for newsletter"
          >
          @error('email')
            <span class="text-xs" style="color: var(--patina-light);">{{ $message }}</span>
          @enderror
          <button type="submit" class="btn-editorial whitespace-nowrap">Subscribe</button>
        </form>
      </div> --}}
 
    </div>
  </section>

@endsection
