{{-- Lang bar --}}
{{-- <div class="lang-bar">
  <button class="lang-btn active" onclick="setLang('es')">ES</button>
  <button class="lang-btn" onclick="setLang('en')">EN</button>
  <button class="lang-btn" onclick="setLang('de')">DE</button>
</div> --}}

{{-- Main nav --}}
<nav id="mainNav">
  {{-- <a href="{{ route('home') }}" class="nav-logo">
    von<span>G</span>riesheim </span><em> Real Estate</em>
  </a> --}}
  <a href="{{ route('home') }}" class="nav-logo">
    vonGriesheim <em> Estates</em>
  </a>
  {{-- <a href="#" class="nav-logo">von<span>G</span>riesheim</a> --}}

  {{-- Desktop links — centro --}}
  <ul class="nav-links-desktop">
    <li><a href="{{ route('home') }}#coleccion" data-i18n="nav_collection">La Colección</a></li>
    {{-- <li><a href="{{ route('home') }}#nosotros"  data-i18n="nav_about">Nosotros</a></li> --}}
    <li><a href="{{ route('about') }}" data-i18n="nav_about">Nosotros</a></li>
    <li><a href="{{ route('home') }}#bodas"     data-i18n="nav_weddings">Bodas</a></li>
    <li><a href="{{ route('home') }}#isla"      data-i18n="nav_island">Korčula</a></li>
    <li><a href="{{ route('home') }}#contacto"  data-i18n="nav_contact">Contacto</a></li>
  </ul>

  {{-- Derecha: idiomas en desktop, hamburguesa en móvil --}}
  <div class="nav-right">
    {{-- Idiomas desktop --}}
    <div class="nav-lang-inline">
      <button class="lang-btn active" onclick="setLang('es')">ES</button>
      <button class="lang-btn" onclick="setLang('en')">EN</button>
      <button class="lang-btn" onclick="setLang('de')">DE</button>
    </div>
    {{-- Hamburguesa móvil --}}
    <button id="mobileMenuBtn" aria-label="Abrir menú">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: #f0e8d8;">
        <line x1="4" y1="8" x2="20" y2="8"></line>
        <line x1="4" y1="16" x2="20" y2="16"></line>
      </svg>
    </button>
  </div>

</nav>