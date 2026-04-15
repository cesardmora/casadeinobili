@props(['property'])

@if($property->is_coming_soon)
  {{-- Coming Soon card --}}
  <div class="property-card h-96 lg:h-[500px] reveal reveal-delay-4" style="background: var(--adriatic-deep);">
    <div class="absolute inset-0 z-10 flex flex-col justify-center items-center text-center p-8">
      <span class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Próximamente</span>
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
  {{-- Regular property card --}}
  <a href="{{ route('properties.show', $property) }}"
     class="property-card h-96 lg:h-[500px] reveal reveal-delay-{{ $loop->index + 1 }} block">

    <img
      src="{{ $property->image_url }}"
      alt="{{ $property->name }}"
      class="property-image absolute inset-0 w-full h-full object-cover"
      loading="lazy"
    >

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
        <p class="text-xs tracking-widest uppercase" style="color: var(--patina-light);">
          {{ $property->guest_summary }}
        </p>
      @endif
    </div>

  </a>
@endif
