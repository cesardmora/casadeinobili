<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-700">
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    <div class="flex items-center justify-between h-20 lg:h-24">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="nav-logo font-display text-2xl lg:text-3xl tracking-wide" style="color: var(--ink);">
        Case dei Nobili
      </a>

      {{-- Desktop navigation --}}
      <div class="hidden md:flex items-center gap-12">
        <a href="{{ route('home') }}#coleccion" class="text-xs tracking-widest uppercase opacity-70 hover:opacity-100 transition-opacity" style="color: var(--ink);">La Colección</a>
        <a href="{{ route('home') }}#historia"  class="text-xs tracking-widest uppercase opacity-70 hover:opacity-100 transition-opacity" style="color: var(--ink);">Historia</a>
        <a href="{{ route('home') }}#bodas"     class="text-xs tracking-widest uppercase opacity-70 hover:opacity-100 transition-opacity" style="color: var(--ink);">Bodas</a>
        <a href="{{ route('home') }}#contacto"  class="text-xs tracking-widest uppercase opacity-70 hover:opacity-100 transition-opacity" style="color: var(--ink);">Contacto</a>
      </div>

      {{-- Mobile menu button --}}
      <button id="mobileMenuBtn" class="md:hidden p-2" aria-label="Abrir menú">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
          <line x1="4" y1="8" x2="20" y2="8"></line>
          <line x1="4" y1="16" x2="20" y2="16"></line>
        </svg>
      </button>

    </div>
  </div>
</nav>
