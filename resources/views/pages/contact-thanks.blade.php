@extends('layouts.app')

@section('title', 'Thank You | Case dei Nobili')

@section('content')
  <section class="hero-section flex items-center justify-center" style="background: var(--adriatic-deep);">
    <div class="text-center px-6 reveal">
      <p class="text-xs tracking-widest uppercase mb-8" style="color: var(--patina);">Enquiry received</p>
        <h1 class="font-display text-5xl md:text-7xl font-light mb-8" style="color: var(--stone-light);">
              Thank you for<br>
        <em style="color: var(--patina-light);">writing to us</em>
        </h1>
      <p class="text-lg font-light max-w-xl mx-auto mb-12" style="color: var(--stone); opacity: 0.7;">
              We have received your enquiry and will get back to you within 48 hours.
      </p>
      <a href="{{ route('home') }}" class="btn-editorial inline-block">Back to home</a>
    </div>
  </section>
@endsection
