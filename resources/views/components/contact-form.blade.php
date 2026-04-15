@props(['properties' => collect(), 'inquiryType' => null])

<form action="{{ route('contact.store') }}" method="POST" class="space-y-6" novalidate>
  @csrf
  @if($inquiryType)
    <input type="hidden" name="inquiry_type" value="{{ $inquiryType }}">
  @endif

  {{-- Name + Email --}}
  <div class="grid sm:grid-cols-2 gap-4">
    <div>
      <input
        type="text"
        name="name"
        value="{{ old('name') }}"
        placeholder="Your name *"
        required
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none @error('name') border-red-400 @enderror"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
      >
      @error('name')
        <p class="text-xs mt-1" style="color: var(--patina-light);">{{ $message }}</p>
      @enderror
    </div>
    <div>
      <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="Your email *"
        required
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none @error('email') border-red-400 @enderror"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
      >
      @error('email')
        <p class="text-xs mt-1" style="color: var(--patina-light);">{{ $message }}</p>
      @enderror
    </div>
  </div>

  {{-- Phone + Property --}}
  <div class="grid sm:grid-cols-2 gap-4">
    <div>
      <input
        type="tel"
        name="phone"
        value="{{ old('phone') }}"
        placeholder="Phone"
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
      >
    </div>
    @if($properties->count())
    <div>
      <select
        name="property_id"
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none appearance-none"
        style="background: var(--adriatic-deep); border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
      >
        <option value="">Property of interest</option>
        @foreach($properties as $property)
          @unless($property->is_coming_soon)
            <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
              {{ $property->name }}
            </option>
          @endunless
        @endforeach
      </select>
    </div>
    @endif
  </div>

  {{-- Dates + Guests --}}
  <div class="grid sm:grid-cols-3 gap-4">
    <div>
      <input
        type="date"
        name="arrival_date"
        value="{{ old('arrival_date') }}"
        placeholder="Arrival"
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light); color-scheme: dark;"
      >
      @error('arrival_date')
        <p class="text-xs mt-1" style="color: var(--patina-light);">{{ $message }}</p>
      @enderror
    </div>
    <div>
      <input
        type="date"
        name="departure_date"
        value="{{ old('departure_date') }}"
        placeholder="Departure"
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light); color-scheme: dark;"
      >
    </div>
    <div>
      <input
        type="number"
        name="guests"
        value="{{ old('guests') }}"
        placeholder="Number of guests"
        min="1"
        max="20"
        class="w-full px-6 py-4 text-sm font-light border focus:outline-none"
        style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
      >
    </div>
  </div>

  {{-- Message --}}
  <div>
    <textarea
      name="message"
      rows="5"
      placeholder="Your message *"
      required
      class="w-full px-6 py-4 text-sm font-light border focus:outline-none resize-none @error('message') border-red-400 @enderror"
      style="background: transparent; border-color: rgba(184,149,107,0.3); color: var(--stone-light);"
    >{{ old('message') }}</textarea>
    @error('message')
      <p class="text-xs mt-1" style="color: var(--patina-light);">{{ $message }}</p>
    @enderror
  </div>

  <button type="submit" class="btn-editorial">Send Inquiry</button>
</form>
