@extends('layouts.app')

@section('title', 'Nosotros | vonGriesheim Estates')
@section('meta_description', 'Conoce la historia y el equipo detrás de Case dei Nobili — una colección privada de residencias históricas en Korčula.')

@section('content')

  {{-- Hero --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    <img
      src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1800&q=85"
      alt="Nosotros"
      class="hero-img-desktop"
    >
    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-3xl">
          <p class="text-xs tracking-widest uppercase mb-6 opacity-60" style="color: var(--stone);"
             data-i18n="about_eyebrow">Nuestra Filosofía</p>
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8"
              style="color: var(--stone-light);">
            <span data-i18n="about_title_1">Preservar para</span><br>
            <em style="color: var(--patina-light);" data-i18n="about_title_2">habitar</em>
          </h1>
          <p class="text-lg font-light leading-relaxed max-w-xl"
             style="color: var(--stone); opacity: 0.8;"
             data-i18n="about_text1">
            Cada restauración es un acto de reverencia. Trabajamos con artesanos locales, utilizando técnicas centenarias y materiales de la isla, para que cada casa mantenga su alma intacta.
          </p>
        </div>
      </div>
    </div>

    <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10">
      <div class="flex flex-col items-center gap-4 opacity-50">
        <span class="text-xs tracking-widest uppercase" style="color: var(--stone);">Descubrir</span>
        <div class="w-px h-16 relative overflow-hidden" style="background: rgba(245,242,237,0.3);">
          <div class="absolute top-0 left-0 w-full h-1/2 animate-pulse" style="background: var(--patina);"></div>
        </div>
      </div>
    </div>
  </section>

  {{-- Historia --}}
  <section class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

        <div class="reveal">
          <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Nuestra Historia</p>
          <h2 class="font-display text-4xl md:text-5xl font-light leading-tight mb-8" style="color: var(--ink);">
            Cinco siglos en<br>
            <em class="italic" style="color: var(--adriatic);">nuestras manos</em>
          </h2>
          <div class="w-24 h-px mb-8 line-reveal" style="background: var(--patina);"></div>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-6 text-red-800"
          {{-- style="color: var(--ink-soft);" --}}
          data-i18n="about_text3">
            {{-- Tatjana von Griesheim-Radović, a landscape architect with Montenegrin roots, and Georg von Griesheim, of German descent, born in Colombia and formerly an investment banker and publisher, share a long-standing passion for exceptional properties - often in historic or culturally significant locations.

            What began as a personal interest gradually evolved into a professional venture focused on the careful restoration and development of distinctive residences. Working with historic buildings requires time, dedication, and respect for their original character; every project is therefore unique.

            Through TCG Unique Properties d.o.o. (Croatia) and TCG Sustainable Investments S.L. (Spain), the group develops and manages a select portfolio of high-quality residential properties. <br> --}}
          </p>
          <p class="text-base lg:text-lg font-light leading-relaxed mb-8" style="color: var(--ink-soft);" >
            vonGriesheim Estates nació de la convicción de que el patrimonio histórico más extraordinario merece ser habitado, no solo contemplado. Hace más de una década, Friedrich von Griesheim descubrió en Korčula un tesoro oculto: un conjunto de palacios medievales abandonados que guardaban siglos de historia dá<lmata class="br"></lmata>
            Desde entonces, cada restauración ha sido un acto de amor y rigor. Trabajamos bajo las estrictas directrices de la conservación patrimonial, preservando cada arco, cada bóveda, cada susurro del pasado — mientras incorporamos el confort contemporáneo con la máxima sutileza.
          </p>
        </div>

        <div class="reveal reveal-delay-2">
          <div class="relative aspect-[4/5]">
            <img
              src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80"
              alt="Historia vonGriesheim"
              class="w-full h-full object-cover"
              loading="lazy"
            >
            <div class="absolute bottom-0 left-0 right-0 p-8"
                 style="background: linear-gradient(to top, rgba(13,31,40,0.8), transparent);">
              <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">Korčula, Croacia</p>
              <p class="font-display text-lg mt-1" style="color: var(--stone-light);">
                Cinco siglos de historia dálmata
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- Valores --}}
  <section class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--stone);">
    <div class="max-w-7xl mx-auto">

      <div class="text-center mb-16 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Lo que nos guía</p>
        <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--ink);">
          Nuestros <em class="italic" style="color: var(--adriatic);">valores</em>
        </h2>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($values as $i => $value)
          <div class="reveal reveal-delay-{{ $i + 1 }} p-8 border" style="background: var(--stone-light); border-color: rgba(184,149,107,0.2);">
            <div class="w-8 h-px mb-6" style="background: var(--patina);"></div>
            <h3 class="font-display text-xl font-light mb-4" style="color: var(--ink);">
              {{ $value['title'] }}
            </h3>
            <p class="text-sm font-light leading-relaxed" style="color: var(--ink-soft); opacity: 0.8;">
              {{ $value['text'] }}
            </p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- Equipo --}}
  <section class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-7xl mx-auto">

      <div class="mb-16 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Las personas</p>
        <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--ink);">
          El <em class="italic" style="color: var(--adriatic);">equipo</em>
        </h2>
      </div>

      <div class="grid md:grid-cols-3 gap-12 lg:gap-16">
        @foreach($team as $i => $member)
          <div class="reveal reveal-delay-{{ $i + 1 }}">
            <div class="aspect-[3/4] overflow-hidden mb-6">
              <img
                src="{{ $member['image'] }}"
                alt="{{ $member['name'] }}"
                class="w-full h-full object-cover property-image"
                loading="lazy"
              >
            </div>
            <p class="text-xs tracking-widest uppercase mb-2" style="color: var(--patina);">
              {{ $member['role'] }}
            </p>
            <h3 class="font-display text-2xl font-light mb-3" style="color: var(--ink);">
              {{ $member['name'] }}
            </h3>
            <div class="w-8 h-px mb-4" style="background: var(--patina);"></div>
            <p class="text-sm font-light leading-relaxed" style="color: var(--ink-soft);">
              {{ $member['bio'] }}
            </p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- Stats --}}
  <section class="py-24 px-6 lg:px-12 private-section">
    <div class="max-w-7xl mx-auto relative z-10">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div class="reveal">
          <p class="font-display text-5xl lg:text-7xl font-light mb-2" style="color: var(--patina-light);">4</p>
          <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.6;">Residencias</p>
        </div>
        <div class="reveal reveal-delay-1">
          <p class="font-display text-5xl lg:text-7xl font-light mb-2" style="color: var(--patina-light);">V</p>
          <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.6;">Siglos de historia</p>
        </div>
        <div class="reveal reveal-delay-2">
          <p class="font-display text-5xl lg:text-7xl font-light mb-2" style="color: var(--patina-light);">+10</p>
          <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.6;">Años restaurando</p>
        </div>
        <div class="reveal reveal-delay-3">
          <p class="font-display text-5xl lg:text-7xl font-light mb-2" style="color: var(--patina-light);">1</p>
          <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.6;">Isla única</p>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="py-24 px-6 text-center" style="background: var(--stone-light);">
    <div class="max-w-2xl mx-auto reveal">
      <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">¿Listo para habitar la historia?</p>
      <h2 class="font-display text-4xl md:text-5xl font-light mb-8" style="color: var(--ink);">
        Explore la <em class="italic" style="color: var(--adriatic);">colección</em>
      </h2>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}#coleccion" class="btn-editorial inline-block">
          Ver las propiedades
        </a>
        <a href="{{ route('home') }}#contacto"
           class="inline-block px-10 py-4 text-xs tracking-widest uppercase border"
           style="border-color: rgba(184,149,107,0.4); color: var(--ink);">
          Contactar
        </a>
      </div>
    </div>
  </section>

@endsection