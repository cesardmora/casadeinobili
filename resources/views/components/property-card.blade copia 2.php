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
    </div>
  </div>

@else
  {{-- Regular property card — el contenedor ya NO es el <a> --}}
  <div class="property-card h-96 lg:h-[500px] reveal reveal-delay-{{ $loop->index + 1 }} relative">
    <img
      src="{{ $property->image_url }}"
      alt="{{ $property->name }}"
      class="property-image absolute inset-0 w-full h-full object-cover"
      loading="lazy"
    >

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

      {{-- Botones --}}
      <div class="flex gap-3 flex-wrap">
        <a href="{{ route('properties.show', $property) }}"
           class="text-xs tracking-widest uppercase px-4 py-2 border"
           style="border-color: rgba(245,242,237,0.4); color: var(--stone-light);">
          View property →
        </a>

        @if($property->airbnb_url)
          <a href="{{ $property->airbnb_url }}" target="_blank" rel="noopener"
             class="text-xs tracking-widest uppercase px-4 py-2"
             style="background: var(--patina); color: var(--stone-light);">
             Booking Request →
          </a>
        @endif
      </div>

    </div>
  </div>
@endif