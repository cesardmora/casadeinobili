@extends('layouts.app')

@section('title', 'Case dei Nobili | Una colección de cinco siglos en Korčula')

@section('content')

  {{-- ===================== HERO ===================== --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    {{-- <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div> --}}

    <img
      src="{{ asset('images/hero-desktop.jpg') }}"
      alt="Case dei Nobili"
      class="absolute inset-0 w-full h-full object-cover hidden md:block"
      style="opacity: 0.45;">

    <img
      src="TU_IMAGEN_MOVIL.jpg"
      alt="Case dei Nobili"
      class="absolute inset-0 w-full h-full object-cover block md:hidden"
      style="opacity: 0.45;">

    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-3xl">
          <p class="text-xs tracking-widest uppercase mb-8 opacity-60" style="color: var(--stone);">
            Korčula, Croacia
          </p>
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8" style="color: var(--stone-light);">
            Una colección de<br>
            <em class="font-normal" style="color: var(--patina-light);">cinco siglos</em>
          </h1>
          <p class="text-lg md:text-xl font-light leading-relaxed mb-12 max-w-xl" style="color: var(--stone); opacity: 0.8;">
            Cuatro residencias históricas en la isla de Korčula. Cada una, un capítulo habitable de la historia dálmeta.
          </p>
          <a href="#coleccion" class="btn-editorial inline-block">
            Explorar la colección
          </a>
        </div>
      </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10">
      <div class="flex flex-col items-center gap-4 opacity-50">
        <span class="text-xs tracking-widest uppercase" style="color: var(--stone);">Descubrir</span>
        <div class="w-px h-16 relative overflow-hidden" style="background: rgba(245,242,237,0.3);">
          <div class="absolute top-0 left-0 w-full h-1/2 animate-pulse" style="background: var(--patina);"></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== HERO 2 ===================== --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-3xl">
          <p class="text-xs tracking-widest uppercase mb-8 opacity-60" style="color: var(--stone);"
            data-i18n="hero_location">Korčula, Croacia</p>
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8"
              style="color: var(--stone-light);">
            <span data-i18n="hero_title_1">Una colección de</span><br>
            <em class="font-normal" style="color: var(--patina-light);"
                data-i18n="hero_title_2">cinco siglos</em>
          </h1>
          <p class="text-lg md:text-xl font-light leading-relaxed mb-12 max-w-xl"
            style="color: var(--stone); opacity: 0.8;"
            data-i18n="hero_subtitle">
            Cuatro residencias históricas en la isla de Korčula. Cada una, un capítulo habitable de la historia dálmata.
          </p>
          <a href="#coleccion" class="btn-editorial inline-block" data-i18n="hero_cta">
            Explorar la colección
          </a>
        </div>
      </div>
    </div>

    <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10">
      <div class="flex flex-col items-center gap-4 opacity-50">
        <span class="text-xs tracking-widest uppercase" style="color: var(--stone);"
              data-i18n="hero_scroll">Descubrir</span>
        <div class="w-px h-16 relative overflow-hidden" style="background: rgba(245,242,237,0.3);">
          <div class="absolute top-0 left-0 w-full h-1/2 animate-pulse" style="background: var(--patina);"></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== INTRO ===================== --}}
  <section class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

        <div class="reveal">
          <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">La Piedra y el Mar</p>
          <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light leading-tight mb-8" style="color: var(--ink);">
            Donde la piedra<br>
            <em class="italic" style="color: var(--adriatic);">encuentra al mar</em>
          </h2>
          <div class="w-24 h-px mb-8 line-reveal" style="background: var(--patina);"></div>
        </div>

        <div class="reveal reveal-delay-2">
          <p class="text-base lg:text-lg font-light leading-relaxed mb-6" style="color: var(--ink-soft);">
            Case dei Nobili es una colección de residencias nobles restauradas con rigor y habitadas con sensibilidad. No museos, sino hogares vivos donde el pasado y el presente coexisten en perfecta armonía.
          </p>
          <p class="text-base lg:text-lg font-light leading-relaxed" style="color: var(--ink-soft);">
            Cada propiedad ha sido seleccionada por su valor histórico excepcional y su ubicación dentro del casco medieval de Korčula, declarado Patrimonio de la Humanidad.
          </p>
        </div>

      </div>
    </div>
  </section>

  {{-- ===================== COLLECTION ===================== --}}
  <section id="coleccion" class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--stone);">
    <div class="max-w-7xl mx-auto">

      {{-- Section header --}}
      <div class="mb-16 lg:mb-20 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">La Colección</p>
        <div class="flex items-end justify-between gap-8">
          <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--ink);">
            Las cuatro casas
          </h2>
          <div class="hidden md:block w-32 h-px" style="background: var(--patina-light);"></div>
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

  {{-- ===================== HISTORY / PHILOSOPHY ===================== --}}
  <section id="nosotros" class="py-24 lg:py-40 px-6 lg:px-12 relative overflow-hidden" style="background: var(--stone-light);">
    {{-- <section id="nosotros" class="py-24 lg:py-40 px-6 lg:px-12 relative overflow-hidden" --}}

    <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block" aria-hidden="true">
      <div class="chapter-number absolute top-1/2 right-12 transform -translate-y-1/2">V</div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">

        {{-- Image --}}
        <div class="reveal order-2 lg:order-1">
          <div class="relative aspect-[4/5]">
            <img
              src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800&q=80"
              alt="Detalle arquitectónico de piedra caliza"
              class="w-full h-full object-cover"
              loading="lazy"
            >
            <div class="absolute bottom-0 left-0 right-0 p-8" style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
              <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">Piedra caliza de Korčula</p>
              <p class="font-display text-lg mt-1" style="color: var(--stone-light);">
                Extraída de las canteras de la isla durante cinco siglos
              </p>
            </div>
          </div>
        </div>

        {{-- Content --}}
        {{-- Content --}}
      <div class="flex flex-col justify-center order-1 lg:order-2">
        <div class="reveal">
          <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);"
            data-i18n="about_eyebrow">Nuestra Filosofía</p>
          <h2 class="font-display text-4xl md:text-5xl font-light leading-tight mb-8" style="color: var(--ink);">
            <span data-i18n="about_title_1">Preservar para</span><br>
            <em class="italic" style="color: var(--adriatic);"
                data-i18n="about_title_2">habitar</em>
          </h2>
        </div>

        <div class="reveal reveal-delay-2">
          <div class="w-24 h-px mb-8" style="background: var(--patina);"></div>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-6" style="color: var(--ink-soft);"
            data-i18n="about_text1">
            Cada restauración es un acto de reverencia. Trabajamos con artesanos locales, utilizando técnicas centenarias y materiales de la isla, para que cada casa mantenga su alma intacta.
          </p>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-8" style="color: var(--ink-soft);"
            data-i18n="about_text2">
            No creamos espacios para turistas. Creamos hogares para viajeros que buscan habitar la historia, aunque sea por unos días.
          </p>
        </div>

        <div class="reveal reveal-delay-3 grid grid-cols-3 gap-8 mt-8">
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--adriatic);">{{ $stats['properties'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--ink-soft);"
              data-i18n="stat_properties">Propiedades</p>
          </div>
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--adriatic);">{{ $stats['centuries'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--ink-soft);"
              data-i18n="stat_centuries">Siglos</p>
          </div>
          <div class="text-center">
            <p class="font-display text-4xl lg:text-5xl font-light" style="color: var(--adriatic);">{{ $stats['island'] }}</p>
            <p class="text-xs tracking-widest uppercase mt-2" style="color: var(--ink-soft);"
              data-i18n="stat_island">Isla</p>
          </div>
        </div>
      </div>

      </div>
    </div>
  </section>

  {{-- ===================== WEDDINGS ===================== --}}
  <section id="bodas" class="private-section py-24 lg:py-40 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto relative z-10">

      {{-- Header --}}
      <div class="text-center mb-16 reveal">
        <div class="inline-flex items-center gap-3 px-5 py-2 border mb-8" style="border-color: rgba(184,149,107,0.3); border-radius: 2px;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span class="text-xs tracking-widest uppercase" style="color: var(--patina);">Acceso Privado</span>
        </div>
        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-6" style="color: var(--stone-light);">
          Bodas en Case dei Nobili
        </h2>
        <p class="text-base lg:text-lg font-light max-w-2xl mx-auto" style="color: var(--stone); opacity: 0.7;">
          Exclusivo para wedding planners y agencias de lujo
        </p>
      </div>

      {{-- Features grid --}}
      <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">

        <div class="reveal reveal-delay-1 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(13,31,40,0.3);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Espacios Únicos</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Patios medievales, terrazas con vistas al Adriático y salones históricos para celebraciones íntimas o eventos exclusivos de hasta 80 invitados.
          </p>
        </div>

        <div class="reveal reveal-delay-2 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(13,31,40,0.3);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Alojamiento Integral</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Alojamiento para la familia nupcial en nuestras propiedades históricas. Cada habitación cuenta una historia, cada amanecer es una promesa.
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
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);">Red de Colaboradores</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;">
            Acceso a nuestra curaduría de proveedores locales: chefs privados, floristas, fotógrafos y músicos que conocen cada rincón de nuestras casas.
          </p>
        </div>

      </div>

      {{-- CTA --}}
      <div class="text-center mt-16 reveal reveal-delay-4">
        <p class="text-sm font-light mb-8 max-w-lg mx-auto" style="color: var(--stone); opacity: 0.6;">
          Solicite acceso a nuestro dossier exclusivo para profesionales. Respuesta en 48 horas.
        </p>
        <a href="#contacto" class="btn-editorial inline-block">Solicitar Dossier</a>
      </div>

    </div>
  </section>

  {{-- ===================== ISLA KORČULA ===================== --}}
  <section id="isla" class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--ink);">
    <div class="max-w-7xl mx-auto">

      <div class="text-center mb-16 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);"
           data-i18n="isl_eyebrow">El Escenario</p>
        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-light mb-6"
            style="color: var(--stone-light);">
          <span data-i18n="isl_title">Korčula — <em style="color: var(--patina-light);">la isla que<br>el tiempo refinó</em></span>
        </h2>
      </div>

      <div class="grid lg:grid-cols-3 gap-8 lg:gap-12 mb-20">

        {{-- Historia --}}
        <div class="reveal reveal-delay-1 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.03);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
              <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);"
              data-i18n="isl1_title">Historia y Patrimonio</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl1_text">
            Lugar de nacimiento de Marco Polo. Siglos de cultura veneciana, bizantina y dálmata esculpidos en cada piedra.
          </p>
        </div>

        {{-- Gastronomía --}}
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
              data-i18n="isl2_title">Gastronomía y Vino</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl2_text">
            Vino blanco Pošip, Grk, marisco fresco. Korčula es uno de los mejores destinos gastronómicos de Croacia.
          </p>
        </div>

        {{-- Mar --}}
        <div class="reveal reveal-delay-3 p-8 lg:p-10 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.03);">
          <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: var(--patina);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="color: var(--patina);">
              <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </div>
          <h3 class="font-display text-2xl font-light mb-4" style="color: var(--stone-light);"
              data-i18n="isl3_title">Vela y el Mar</h3>
          <p class="text-sm font-light leading-relaxed" style="color: var(--stone); opacity: 0.7;"
             data-i18n="isl3_text">
            Aguas cristalinas, calas escondidas y conexiones directas con Hvar, Dubrovnik y el archipiélago dálmata.
          </p>
        </div>

      </div>

      {{-- Imagen panorámica --}}
      <div class="reveal aspect-[21/9] overflow-hidden" style="min-height: 300px;">
        <img
          src="https://images.unsplash.com/photo-1555990793-da11153b2473?w=1800&q=85"
          alt="Korčula"
          class="w-full h-full object-cover"
          loading="lazy"
          style="filter: brightness(0.7);"
        >
      </div>

    </div>
  </section>

@endsection
