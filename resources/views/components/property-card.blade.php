@props(['property'])
@if($property->is_coming_soon)
  {{-- Coming Soon card --}}
  <div class="property-card h-96 lg:h-[500px] reveal reveal-delay-4" style="background: var(--adriatic-deep);">
    <div class="absolute inset-0 z-10 flex flex-col justify-center items-center text-center p-8">
      <span class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Coming Soon</span>
      <h3 class="font-display text-3xl lg:text-4xl font-light mb-4" style="color: var(--stone-light);">
        {{ $property->name }}
      </h3>
      <div class="w-12 h-px mb-4" style="background: var(--patina);"></div>
      <p class="text-sm font-light max-w-xs" style="color: var(--stone); opacity: 0.6;">
        {{ $property->description }}
      </p>

      {{-- Botón interés en coming soon --}}
      {{-- <a href="mailto:info@vongriesheim.com?subject=Interés%20{{ urlencode($property->name) }}"
         class="mt-6 text-xs tracking-widest uppercase px-4 py-2 border"
         style="border-color: rgba(184,149,107,0.4); color: var(--patina);">
        Register Interest →
      </a> --}}
    </div>
  </div>

@else
  {{-- Regular property card --}}
  <div class="property-card h-96 lg:h-[500px] reveal reveal-delay-{{ $loop->index + 1 }} relative overflow-hidden group cursor-pointer">
    <img
      src="{{ $property->image_url }}"
      alt="{{ $property->name }}"
      class="property-image absolute inset-0 w-full h-full object-cover"
     
      loading="lazy"
    >

    {{-- Botón "Register Interest" — arriba derecha, pequeño --}}
    {{-- <div class="absolute top-4 right-4 z-20">
      <a href="mailto:info@vongriesheim.com?subject=Interest%20{{ urlencode($property->name) }}"
         class="text-xs tracking-widest uppercase px-3 py-1.5"
         style="background: rgba(40, 75, 93, 0.7); color: var(--patina-light); border: 1px solid rgba(255, 255, 255, 0.183); backdrop-filter: blur(4px); letter-spacing: 0.1em;">
        Register Interest →
      </a>
    </div> --}}

    {{-- Overlay con info --}}
    <div class="absolute inset-0 z-10 flex flex-col justify-end p-8 lg:p-10">
      @if($property->century)
        <span class="century-badge mb-4 w-fit">
          <span>{{ $property->century }}</span>
        </span>
      @endif

      <h3 class="property-title font-display text-3xl lg:text-4xl font-light mb-2" style="color: var(--stone-light);">
        {{ $property->name }}
      </h3>
      <div class="property-line mb-4"></div>

      @if($property->tagline)
        <p class="text-sm font-light mb-4 max-w-xs" style="color: var(--stone); opacity: 0.8;">
          {{ $property->tagline }}
        </p>
      @endif

      @if($property->guests || $property->bedrooms)
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina-light);">
          {{ $property->guest_summary }}
        </p>
      @endif

      {{-- Botones inferiores --}}
      <div class="flex gap-3 flex-wrap">
        <a href="{{ route('properties.show', $property) }}"
           class="text-xs tracking-widest uppercase px-4 py-2 border"
           style="border-color: rgba(245,242,237,0.4); color: var(--stone-light);">
          View property →
        </a>

        @if($property->airbnb_url)
          <a href="mailto:info@vongriesheim.com?subject=Booking%20Request%20{{ urlencode($property->name) }}&amp;body=Hello%2C%20I%27m%20requesting%20dates%20for%20a%20reservation%2C%20and%20the%20number%20of%20people%20is%20..." target="_blank" rel="noopener"
             class="text-xs tracking-widest uppercase px-4 py-2"
             style="background: var(--patina); color: var(--stone-light);">
             Booking Request →
          </a>
        @endif
      </div>

    </div>
  </div>
@endif
