@extends('layouts.app')

@section('title', 'Privacy Policy | Case dei Nobili')
@section('meta_description', 'Privacy policy for Case dei Nobili — a private collection of historic residences in Korčula.')
@section('canonical', url()->current())

@section('content')
  <div class="pt-32 pb-24 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-3xl mx-auto">
      <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Legal</p>
      <h1 class="font-display text-4xl md:text-5xl font-light mb-12" style="color: var(--ink);">
        Privacy Policy
      </h1>

      <div class="prose prose-lg font-light space-y-8" style="color: var(--ink-soft);">
        <p>
          This website is operated by von Griesheim S.L.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">We respect your privacy.</h2>
        <p>
          This website does not use cookies, tracking technologies, or analytics tools. No personal data is automatically collected when you visit this website. Personal information will only be processed if you voluntarily provide it to us, for example by contacting us via email.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Any information you provide</h2>
        <p>
          will be used solely to respond to your inquiry and will not be shared with third parties unless required by law.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Your rights</h2>
        <p>
          If you have any questions regarding privacy, please contact:
          <a href="mailto:info@casadeinobili.com" style="color: var(--patina);">georg@vonGriesheim.com</a>.
        </p>
      </div>

      <div class="mt-16">
        <a href="{{ route('home') }}" class="text-xs tracking-widest uppercase hover:underline" style="color: var(--patina);">
          ← Back to home
        </a>
      </div>
    </div>
  </div>
@endsection
