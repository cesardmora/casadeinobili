{{-- <div id="mobileMenu" class="fixed inset-0 z-40 hidden" style="background: var(--stone-light);">
  <div class="flex flex-col items-center justify-center h-full gap-8">
    <a href="{{ route('home') }}#coleccion" class="font-display text-3xl" style="color: var(--ink);">La Colección</a>
    <a href="{{ route('home') }}#historia"  class="font-display text-3xl" style="color: var(--ink);">Historia</a>
    <a href="{{ route('home') }}#bodas"     class="font-display text-3xl" style="color: var(--ink);">Bodas</a>
    <a href="{{ route('home') }}#contacto"  class="font-display text-3xl" style="color: var(--ink);">Contacto</a>
    <button id="closeMobileMenu" class="mt-8 text-xs tracking-widest uppercase" style="color: var(--patina);">Cerrar</button>
  </div>
</div> --}}

{{-- <div id="mobileMenu" class="fixed inset-0 z-40 hidden" style="background: var(--adriatic-deep);">
  <div class="flex flex-col items-center justify-center h-full gap-8">

    <a href="{{ route('home') }}#coleccion" class="font-display text-3xl" style="color: var(--stone-light);"
       data-i18n="nav_collection">La Colección</a>

    <a href="{{ route('home') }}#nosotros" class="font-display text-3xl" style="color: var(--stone-light);"
       data-i18n="nav_about">Nosotros</a>

    <a href="{{ route('home') }}#bodas" class="font-display text-3xl" style="color: var(--stone-light);"
       data-i18n="nav_weddings">Bodas</a>

    <a href="{{ route('home') }}#isla" class="font-display text-3xl" style="color: var(--stone-light);"
       data-i18n="nav_island">Korčula</a>

    <a href="{{ route('home') }}#contacto" class="font-display text-3xl" style="color: var(--stone-light);"
       data-i18n="nav_contact">Contacto</a>

    <button id="closeMobileMenu" class="mt-8 text-xs tracking-widest uppercase" style="color: var(--patina);">
      Cerrar
    </button>
  </div>
</div> --}}


<div id="mobileMenu" class="fixed inset-0 z-40 hidden" style="background: rgba(13,31,40,0.99);">
  <div class="flex flex-col items-center justify-center h-full gap-8">

    <a href="{{ route('home') }}#coleccion" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_collection">La Colección</a>

    {{-- <a href="{{ route('home') }}#nosotros" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_about">Nosotros</a> --}}
    <a href="{{ route('about') }}" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_about">Nosotros</a>

    <a href="{{ route('home') }}#bodas" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_weddings">Bodas</a>

    <a href="{{ route('home') }}#isla" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_island">Korčula</a>

    <a href="{{ route('home') }}#contacto" class="font-display text-3xl" style="color: #f0e8d8;"
       data-i18n="nav_contact">Contacto</a>

    {{-- Idiomas en móvil --}}
    <div style="display:flex; gap:0; margin-top:1rem;">
      <button class="lang-btn active" onclick="setLang('es')">ES</button>
      <button class="lang-btn" onclick="setLang('en')">EN</button>
      <button class="lang-btn" onclick="setLang('de')">DE</button>
    </div>

    <button id="closeMobileMenu" class="mt-4 text-xs tracking-widest uppercase"
            style="color: #b8933a; background:none; border:1px solid rgba(184,147,58,0.4); padding:0.6rem 2rem; cursor:pointer;">
      Cerrar
    </button>

  </div>
</div>