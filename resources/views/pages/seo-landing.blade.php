@extends('layouts.app')

@section('title', $page['title'])
@section('meta_description', $page['meta_description'])
@section('canonical', route($page['route_name']))
@section('og_image', asset($page['hero_image']))
@section('og_image_alt', $page['hero_alt'])

@push('head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
    { "@type": "ListItem", "position": 2, "name": "{{ strip_tags($page['headline']) }}", "item": "{{ route($page['route_name']) }}" }
  ]
}
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "name": "{{ $page['title'] }}",
      "url": "{{ route($page['route_name']) }}",
      "description": "{{ $page['meta_description'] }}"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        @foreach($page['faq'] as $item)
        {
          "@type": "Question",
          "name": "{{ $item['q'] }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ $item['a'] }}"
          }
        }@if(! $loop->last),@endif
        @endforeach
      ]
    }
  ]
}
</script>
@endpush

@section('content')
  <section class="hero-section">
    <div class="hero-bg"></div>
    <x-responsive-image
      :src="$page['hero_image']"
      :alt="$page['hero_alt']"
      class="hero-img-desktop"
      sizes="100vw"
      :widths="[768, 1280, 1600, 2000]"
      loading="eager"
      fetchpriority="high"
    />
    <div class="hero-overlay"></div>
    <div class="hero-pattern" aria-hidden="true"></div>

    <div class="relative z-10 h-full flex flex-col justify-center px-6 lg:px-12">
      <div class="max-w-7xl mx-auto w-full">
        <div class="max-w-4xl">
          <p class="text-xs tracking-widest uppercase mb-6 opacity-60" style="color: var(--stone);">{{ $page['eyebrow'] }}</p>
          <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-light leading-tight mb-8" style="color: var(--stone-light);">
            {!! $page['headline'] !!}
          </h1>
          <p class="text-lg md:text-xl font-light leading-relaxed max-w-3xl" style="color: var(--stone); opacity: 0.86;">
            {{ $page['intro'] }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 lg:py-24 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-[1.25fr_0.75fr] gap-12 lg:gap-16 items-start">
      <div class="reveal">
        <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">{{ $page['section_title'] }}</p>
        <div class="space-y-6" style="color: var(--ink-soft);">
          @foreach($page['body'] as $paragraph)
            <p class="text-base lg:text-lg font-light leading-relaxed">{{ $paragraph }}</p>
          @endforeach
        </div>
      </div>

      <aside class="reveal reveal-delay-1">
        <div class="rounded-[28px] p-8 border" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.75);">
          <p class="text-xs tracking-widest uppercase mb-5" style="color: var(--patina);">Highlights</p>
          <ul class="space-y-4">
            @foreach($page['highlights'] as $highlight)
              <li class="flex items-start gap-3">
                <span class="mt-2 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background: var(--patina);"></span>
                <span class="text-sm font-light leading-relaxed" style="color: var(--ink-soft);">{{ $highlight }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </aside>
    </div>
  </section>

  <section class="py-16 lg:py-24 px-6 lg:px-12" style="background: var(--ink);">
    <div class="max-w-7xl mx-auto">
      <div class="mb-10 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Selected Residences</p>
        <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--stone-light);">
          The collection behind this <em>experience</em>
        </h2>
      </div>

      <div class="grid md:grid-cols-2 gap-4 lg:gap-6">
        @foreach($properties as $property)
          @include('components.property-card', ['property' => $property])
        @endforeach
      </div>
    </div>
  </section>

  <section class="py-16 lg:py-24 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-12 reveal">
        <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Frequently Asked</p>
        <h2 class="font-display text-4xl md:text-5xl font-light" style="color: var(--ink);">Questions</h2>
      </div>

      <div class="space-y-5">
        @foreach($page['faq'] as $item)
          <article class="reveal rounded-[24px] border px-6 py-6" style="border-color: rgba(184,149,107,0.2); background: rgba(255,255,255,0.8);">
            <h3 class="font-display text-2xl font-light mb-3" style="color: var(--ink);">{{ $item['q'] }}</h3>
            <p class="text-sm lg:text-base font-light leading-relaxed" style="color: var(--ink-soft);">{{ $item['a'] }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="private-section py-20 lg:py-24 px-6 lg:px-12">
    <div class="max-w-3xl mx-auto relative z-10 reveal">
      <p class="text-xs tracking-widest uppercase mb-4" style="color: var(--patina);">Plan Your Stay</p>
      <h2 class="font-display text-4xl font-light mb-8" style="color: var(--stone-light);">
        Explore availability in Korčula
      </h2>
      <p class="text-base font-light leading-relaxed mb-8" style="color: var(--stone); opacity: 0.75;">
        If you are planning a heritage stay, a private group trip or a destination celebration in Korčula, send us your dates and preferences.
      </p>
      <x-contact-form :properties="$properties" inquiry-type="rental" />
    </div>
  </section>
@endsection
