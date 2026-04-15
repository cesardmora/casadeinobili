@extends('layouts.app')

@section('title', 'Properties | Case dei Nobili')
@section('meta_description', 'Explore our collection of historic residences in Korčula — Gothic, Renaissance, and Baroque palaces restored to modern luxury.')
@section('canonical', url()->current())
@section('og_type', 'website')

@push('head')
{{-- JSON-LD BreadcrumbList --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "Properties", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endpush

@section('content')

  {{-- Hero --}}
  <section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full text-center">
        <p class="text-xs tracking-widest uppercase mb-8 opacity-60" style="color: var(--stone);">The Collection</p>
        <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8" style="color: var(--stone-light);">
          Our <em style="color: var(--patina-light);">Properties</em>
        </h1>
        <p class="text-lg md:text-xl font-light leading-relaxed mb-12 max-w-2xl mx-auto" style="color: var(--stone);">
          Four historic residences spanning five centuries of Dalmatian heritage.
        </p>
      </div>
    </div>
  </section>

  {{-- Properties grid --}}
  <section class="py-24 lg:py-32 px-6 lg:px-12" style="background: var(--dark);">
    <div class="max-w-7xl mx-auto">
      <div class="grid md:grid-cols-2 gap-4 lg:gap-6">
        @foreach($properties as $property)
          @include('components.property-card', ['property' => $property])
        @endforeach
      </div>
    </div>
  </section>

  {{-- Contact --}}
  <section class="private-section py-24 lg:py-32 px-6 lg:px-12">
    <div class="max-w-3xl mx-auto relative z-10 reveal">
      <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Get in Touch</p>
      <h2 class="font-display text-4xl font-light mb-8" style="color: var(--stone-light);">
        Interested in a property?
      </h2>
      <p class="text-base font-light leading-relaxed mb-8" style="color: var(--stone); opacity: 0.7;">
        Contact us to check availability and receive a personalized proposal for your stay in Korčula.
      </p>
      <x-contact-form :properties="$properties" inquiry-type="rental" />
    </div>
  </section>

@endsection
