@extends('layouts.app')

@section('title', $property->name . ' | Case dei Nobili')
@section('meta_description', $property->tagline ?? $property->description)
@section('canonical', url()->current())
@section('og_type', 'website')
@if($property->image_url)
@section('og_image', str_starts_with($property->image_url, 'http') ? $property->image_url : asset($property->image_url))
@endif

@push('head')
{{-- JSON-LD Structured Data --}}
{{-- <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["LodgingBusiness", "VacationRental"],
  "name": "{{ $property->name }}",
  "url": "{{ url()->current() }}",

  "priceRange": "€€€€",
  @if($property->amenities)
  "amenityFeature": [
    @foreach($property->amenities as $amenity)
    {
      "@type": "LocationFeatureSpecification",
      "name": "{{ $amenity }}",
      "value": true
    }@if(!$loop->last),@endif
    @endforeach
  ],
  @endif
  @if($property->bedrooms)
  "numberOfBedrooms": {{ $property->bedrooms }},
  @endif
  "petsAllowed": false,
  @if($property->airbnb_url)
  "tourBookingPage": "{{ $property->airbnb_url }}",
  @endif

  "description": "{{ $property->tagline ?? $property->description }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Korčula",
    "addressCountry": "HR"
  },
  @if($property->image_url)"image": "{{ str_starts_with($property->image_url, 'http') ? $property->image_url : asset($property->image_url) }}",@endif
  @if($property->guests)"numberOfRooms": {{ $property->bedrooms ?? 0 }},@endif
  "starRating": {
    "@type": "Rating",
    "ratingValue": "5"
  }
}
</script> --}}

{{-- JSON-LD Structured Data --}}
@php
  $notEmpty = fn ($value) => ! is_null($value) && $value !== '' && $value !== [];

  $description = trim(strip_tags(
      $property->tagline
      ?: $property->description
      ?: $property->long_description
      ?: ''
  ));

  $images = collect([$property->image_url])
      ->merge($property->gallery_images ?? [])
      ->filter(fn ($image) => is_string($image) && trim($image) !== '')
      ->map(fn ($image) => str_starts_with($image, 'http') ? $image : asset($image))
      ->unique()
      ->values()
      ->all();

  $amenityRules = [
      'wifi' => ['wifi', 'wi-fi', 'internet'],
      'tv' => ['smart tv', 'television'],
      'ac' => ['air conditioning', 'a/c'],
      'heating' => ['heating', 'underfloor heating'],
      'fireplace' => ['fireplace'],
      'kitchen' => ['kitchen'],
      'beachAccess' => ['beach', 'waterfront'],
      'childFriendly' => ['family', 'families', 'children'],
  ];

  $amenityFeature = collect($property->amenities ?? [])
      ->flatMap(function ($amenity) use ($amenityRules) {
          $text = strtolower($amenity);

          return collect($amenityRules)
              ->filter(fn ($needles) => collect($needles)->contains(
                  fn ($needle) => str_contains($text, $needle)
              ))
              ->keys()
              ->map(fn ($name) => [
                  '@type' => 'LocationFeatureSpecification',
                  'name' => $name,
                  'value' => true,
              ]);
      })
      ->unique('name')
      ->values()
      ->all();

  $additionalProperty = collect($property->amenities ?? [])
      ->filter()
      ->map(fn ($amenity) => [
          '@type' => 'PropertyValue',
          'name' => trim($amenity),
          'value' => true,
      ])
      ->values()
      ->all();

  $containsPlace = array_filter([
      '@type' => 'Accommodation',
      'additionalType' => 'EntirePlace',
      'name' => $property->name,
      'description' => $description ?: null,
      'occupancy' => $property->guests ? [
          '@type' => 'QuantitativeValue',
          'value' => $property->guests,
          'unitText' => 'guests',
      ] : null,
      'numberOfBedrooms' => $property->bedrooms ?: null,
      'numberOfBathroomsTotal' => $property->bathrooms ?: null,
      'amenityFeature' => $amenityFeature ?: null,
      'additionalProperty' => $additionalProperty ?: null,
      'petsAllowed' => false,
      'smokingAllowed' => false,
  ], $notEmpty);

  $schema = array_filter([
      '@context' => 'https://schema.org',
      '@type' => 'VacationRental',
      '@id' => route('properties.show', $property) . '#vacation-rental',
      'identifier' => 'case-dei-nobili-' . $property->slug,
      'name' => $property->name,
      'url' => route('properties.show', $property),
      'mainEntityOfPage' => [
          '@type' => 'WebPage',
          '@id' => url()->current(),
      ],
      'description' => $description ?: null,
      'brand' => [
          '@type' => 'Brand',
          'name' => 'Case dei Nobili',
          'url' => url('/'),
      ],
      'priceRange' => '€€€€',
      'currenciesAccepted' => 'EUR',
      'telephone' => '+385996551938',
      'address' => [
          '@type' => 'PostalAddress',
          'addressLocality' => 'Korčula',
          'addressRegion' => 'Dubrovnik-Neretva County',
          'addressCountry' => 'HR',
      ],
      'image' => $images ?: null,
      'containsPlace' => $containsPlace,
  ], $notEmpty);

  if ($property->airbnb_url && ! str_contains($property->airbnb_url, '/calendar/ical/')) {
      $schema['sameAs'] = [$property->airbnb_url];
  }

  if (isset($property->latitude, $property->longitude) && $property->latitude && $property->longitude) {
      $schema['latitude'] = (float) $property->latitude;
      $schema['longitude'] = (float) $property->longitude;
      $schema['geo'] = [
          '@type' => 'GeoCoordinates',
          'latitude' => (float) $property->latitude,
          'longitude' => (float) $property->longitude,
      ];
  }
@endphp

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}
</script>


@endpush

@section('content')

  {{-- Hero --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    @if($property->image_url)
      <x-responsive-image
        :src="$property->image_url"
        alt="{{ $property->name }}"
        class="absolute inset-0 w-full h-full object-cover opacity-40"
        sizes="100vw"
        :widths="[768, 1280, 1600, 2000]"
        loading="eager"
        fetchpriority="high"
      />
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
          {{-- <a class="airbnb-banner" href="https://www.airbnb.de/rooms/1138104029716036612" target="_blank">
            <div class="airbnb-dot"></div>
            Currently bookable on Airbnb — The XIV Century Duplex
          </a> --}}
          <div class="reveal reveal-delay-3">
            @if($property->airbnb_url)
            <a href="{{ $property->airbnb_url }}" target="_blank" rel="noopener"
              class="airbnb-banner inline-flex items-center gap-3 mb-10">
              <div class="airbnb-dot"></div>
              <span class="text-sm font-light" style="color: var(--stone);"
                    data-i18n="intro_airbnb">
                Now available on Airbnb — {{ $property->name }}
              </span>
            </a>
            @endif
            <a href="https://wa.me/385996551938?text=Hola,%20me%20interesa%20consultar%20disponibilidad%20para%20fechas%20XXX" 
              class="btn-editorial">
              Check availability → WhatsApp
            </a>
          </div>
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
            <x-responsive-image
              :src="$img"
              alt="{{ $property->name }}"
              class="w-full h-full object-cover property-image"
              sizes="(min-width: 1024px) 50vw, 100vw"
              :widths="[480, 768, 1200, 1600]"
            />
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- Contact / Inquiry --}}
  <section class="private-section py-24 lg:py-32 px-6 lg:px-12">
    <div class="max-w-3xl mx-auto relative z-[999]">
      <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Check Availability</p>
      <h2 class="font-display text-4xl font-light mb-8" style="color: var(--stone-light);">
        Book {{ $property->name }}
      </h2>
      {{-- @dump($property) --}}
      {{-- <x-contact-form :properties=\"collect([$property])\" inquiry-type="rental" /> --}}
      @include('components.contact-form', ['properties' => collect([$property]), 'inquiryType' => 'rental'])

    </div>
  </section>

  {{-- Back link --}}
  <div class="py-12 px-6 text-center" style="background: var(--stone-light);">
    <a href="{{ route('home') }}#collection" class="text-xs tracking-widest uppercase hover:underline" style="color: var(--patina);">
      ← Back to collection
    </a>
  </div>

@endsection
