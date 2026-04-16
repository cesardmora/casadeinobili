@extends('layouts.app')

@section('title', $property->name . ' | Case dei Nobili')
@section('meta_description', $property->tagline ?? $property->description)
@section('canonical', url()->current())
@section('og_type', 'article')
@if($property->image_url)
@section('og_image', $property->image_url)
@endif

@push('head')
{{-- JSON-LD Structured Data --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LodgingBusiness",
  "name": "{{ $property->name }}",
  "url": "{{ url()->current() }}",
  "description": "{{ $property->tagline ?? $property->description }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Korčula",
    "addressCountry": "HR"
  },
  @if($property->image_url)"image": "{{ $property->image_url }}",@endif
  @if($property->guests)"numberOfRooms": {{ $property->bedrooms ?? 0 }},@endif
  "starRating": {
    "@type": "Rating",
    "ratingValue": "5"
  }
}
</script>
@endpush

@section('content')

  {{-- Hero --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    @if($property->image_url)
      <img
        src="{{ $property->image_url }}"
        alt="{{ $property->name }}"
        class="absolute inset-0 w-full h-full object-cover opacity-40"
      >
    @endif
    <div class="hero-overlay"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-3xl">
          @if($property->century)
            <span class="century-badge mb-8 inline-flex">
              <span>{{ $property->century }}</span>
            </span>
          @endif
          <h1 class="font-display text-5xl md:text-7xl font-light leading-tight mb-6" style="color: var(--stone-light);">
            {{ $property->name }}
          </h1>
          @if($property->tagline)
            <p class="text-xl font-light mb-8" style="color: var(--patina-light);">
              {{ $property->tagline }}
            </p>
          @endif
          @if($property->guest_summary)
            <p class="text-sm tracking-widest uppercase" style="color: var(--stone); opacity: 0.7;">
              {{ $property->guest_summary }}
            </p>
          @endif
        </div>
      </div>
    </div>
  </section>

  {{-- Description --}}
  <section class="py-24 lg:py-40 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">

        <div class="reveal">
          <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">{{ $property->tagline }}</p>
          <div class="w-24 h-px mb-8 line-reveal" style="background: var(--patina);"></div>
          <p class="text-lg font-light leading-relaxed mb-6" style="color: var(--ink-soft);">
            {{ $property->description }}
          </p>
          @if($property->long_description)
          {{-- ANTES --}}
            {{-- <p class="text-base font-light leading-relaxed" style="color: var(--ink-soft); opacity: 0.8;">
              {{ $property->long_description }}
            </p> --}}
            {{-- DESPUÉS --}}
            <div class="prose-property">
              {!! Str::markdown($property->long_description ?? '') !!}
            </div>
          @endif
          <a class="airbnb-banner" href="https://www.airbnb.de/rooms/1138104029716036612" target="_blank">
            <div class="airbnb-dot"></div>
            Currently bookable on Airbnb — The XIV Century Duplex
          </a>
        </div>

        {{-- Amenities --}}
        @if($property->amenities && count($property->amenities))
          <div class="reveal reveal-delay-2">
            <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">What's Included</p>
            <ul class="space-y-3">
              @foreach($property->amenities as $amenity)
                <li class="flex items-center gap-3 text-sm font-light" style="color: var(--ink-soft);">
                  <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background: var(--patina);"></span>
                  {{ $amenity }}
                </li>
              @endforeach
            </ul>
          </div>
        @endif

      </div>
    </div>
  </section>

  {{-- Gallery --}}
  @if($property->gallery_images && count($property->gallery_images) > 1)
    <section class="py-12 px-6 lg:px-12" style="background: var(--stone);">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-2 gap-4">
        @foreach($property->gallery_images as $img)
          <div class="aspect-[4/3] overflow-hidden reveal">
            <img src="{{ str_starts_with($img, 'http') ? $img : asset($img) }}" alt="{{ $property->name }}" class="w-full h-full object-cover property-image" loading="lazy">
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- Contact / Inquiry --}}
  <section class="private-section py-24 lg:py-32 px-6 lg:px-12">
    <div class="max-w-3xl mx-auto relative z-10 reveal">
      <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Check Availability</p>
      <h2 class="font-display text-4xl font-light mb-8" style="color: var(--stone-light);">
        Book {{ $property->name }}
      </h2>
      <x-contact-form :properties=\"collect([$property])\" inquiry-type="rental" />
    </div>
  </section>

  {{-- Back link --}}
  <div class="py-12 px-6 text-center" style="background: var(--stone-light);">
    <a href="{{ route('home') }}#collection" class="text-xs tracking-widest uppercase hover:underline" style="color: var(--patina);">
      ← Back to collection
    </a>
  </div>

@endsection