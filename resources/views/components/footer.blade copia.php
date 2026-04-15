<footer id="contacto" class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--ink);">
  <div class="max-w-7xl mx-auto">

    <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 mb-16">

      {{-- Contact info --}}
      <div class="reveal">
        <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Contacto</p>
        <h2 class="font-display text-4xl md:text-5xl font-light mb-8" style="color: var(--stone-light);">
          Comience su<br>
          <em class="italic" style="color: var(--patina-light);">historia</em>
        </h2>
        <p class="text-base font-light mb-8 max-w-md" style="color: var(--stone); opacity: 0.6;">
          Cada reserva es una conversación. Cuéntenos sobre su viaje y le ayudaremos a encontrar la casa perfecta para su estancia en Korčula.
        </p>
        <div class="space-y-4">
          <a href="mailto:case.dei.nobili@vongriesheim.com" class="block text-lg font-light hover:underline" style="color: var(--stone-light);">
            case.dei.nobili@vongriesheim.com
          </a>
          <a href="tel:++385996551938" class="block text-lg font-light hover:underline" style="color: var(--stone-light);">
            Concierge: +385 996 551 938
          </a>
          <p class="text-base font-light" style="color: var(--stone); opacity: 0.6;">
            {{-- <em>VonGriesheim SL · Plaza de Cosme Adrover 2A, 07008 Palma (Spain)</em><br> --}}
            <em>Curator: +34 616 969 596</em><br>
            <em>TCG unique properties d.o.o,</em><br>
             <em>Mazuranicevo šetalište 2, 21000 Split (Croatia) </em><br>
            <em>OIB: HR49441064083</em>
          </p>
        </div>
      </div>

      {{-- Newsletter --}}
      <div class="reveal reveal-delay-2">
        <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Boletín</p>
        <h3 class="font-display text-2xl md:text-3xl font-light mb-6" style="color: var(--stone-light);">
          Historias desde la isla
        </h3>
        <p class="text-sm font-light mb-8" style="color: var(--stone); opacity: 0.6;">
          Reciba crónicas de Korčula, novedades de la colección y ofertas exclusivas antes que nadie.
        </p>

        {{-- Flash message --}}
        @if(session('newsletter_success'))
          <p class="text-sm mb-4" style="color: var(--patina-light);">{{ session('newsletter_success') }}</p>
        @endif

        <form id="newsletterForm"
              action="{{ route('newsletter.store') }}"
              method="POST"
              class="flex flex-col sm:flex-row gap-4">
          @csrf
          <input
            type="email"
            name="email"
            placeholder="Su email"
            required
            class="flex-1 px-6 py-4 text-sm font-light border focus:outline-none focus:border-opacity-100"
            style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
            aria-label="Email para newsletter"
          >
          @error('email')
            <span class="text-xs" style="color: var(--patina-light);">{{ $message }}</span>
          @enderror
          <button type="submit" class="btn-editorial whitespace-nowrap">Suscribirse</button>
        </form>
      </div>

    </div>

    {{-- Bottom bar --}}
    <div class="pt-8 border-t flex flex-col md:flex-row justify-between items-center gap-6" style="border-color: rgba(184,149,107,0.2);">
      <p class="text-xs tracking-widest uppercase" style="color: var(--stone); opacity: 0.4;">
        vonGriesheim Estates {{ date('Y') }}
      </p>
      <div class="flex gap-8">
        <a href="{{ route('privacy') }}" class="text-xs tracking-widest uppercase hover:underline" style="color: var(--stone); opacity: 0.4;">Política de Privacidad</a>
        <a href="{{ route('terms') }}"   class="text-xs tracking-widest uppercase hover:underline" style="color: var(--stone); opacity: 0.4;">Términos</a>
      </div>
    </div>

  </div>

  {{-- Botón volver arriba --}}
  <button id="backToTop" aria-label="Volver arriba" onclick="window.scrollTo({top:0, behavior:'smooth'})">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
      <line x1="12" y1="19" x2="12" y2="5"></line>
      <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
  </button>
</footer>
