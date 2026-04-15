@extends('layouts.app')

@section('title', 'Terms & Conditions | Case dei Nobili')
@section('meta_description', 'Terms and conditions for Case dei Nobili — a private collection of historic residences in Korčula.')
@section('canonical', url()->current())

@section('content')
  <div class="pt-32 pb-24 px-6 lg:px-12" style="background: var(--stone-light);">
    <div class="max-w-3xl mx-auto">
      <p class="text-xs tracking-widest uppercase mb-6" style="color: var(--patina);">Legal</p>
      <h1 class="font-display text-4xl md:text-5xl font-light mb-12" style="color: var(--ink);">
        Terms & Conditions
      </h1>

      <div class="prose prose-lg font-light space-y-8" style="color: var(--ink-soft);">
        <p>
          The use of this website and the booking of our properties are subject to the following terms and conditions.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Bookings</h2>
        <p>
          Bookings are confirmed upon payment of the agreed deposit. Case dei Nobili reserves the right to reject bookings that do not meet our guest profile requirements.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Cancellations</h2>
        <p>
          Cancellation terms are specified in the individual contract for each property. As a general rule, cancellations with more than 60 days' notice will receive a 50% refund of the deposit.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Property Use</h2>
        <p>
          Guests agree to treat the properties with the respect due to their historical and heritage value. Any damage will be the responsibility of the guest.
        </p>
        <h2 class="font-display text-2xl font-light" style="color: var(--ink);">Contact</h2>
        <p>
          For any questions regarding these terms, please contact us at <a href="mailto:info@casadeinobili.com" style="color: var(--patina);">info@casadeinobili.com</a>.
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
