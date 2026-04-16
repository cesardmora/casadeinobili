{{-- Main nav --}}
<nav id="mainNav">
  <a href="{{ route('home') }}" class="nav-logo">
    {{-- Escudo/Logo --}}
    <img src="{{ asset('images/vonGriesheim-shield.svg') }}" 
         alt="vonGriesheim" 
         class="nav-logo-shield">
    
    <span class="nav-logo-text">vonGriesheim</span>
  </a>

  {{-- Desktop links — center --}}
  <ul class="nav-links-desktop">
    @if(request()->routeIs('home'))
      <li><a href="#collection" data-i18n="nav_collection">The Collection</a></li>
      <li><a href="{{ route('about') }}" data-i18n="nav_about">About</a></li>
      <li><a href="#weddings"     data-i18n="nav_weddings">Weddings</a></li>
      <li><a href="#island"      data-i18n="nav_island">Korčula</a></li>
      <li><a href="#contact"  data-i18n="nav_contact">Contact</a></li>
    @else
      <li><a href="{{ route('home') }}#collection" data-i18n="nav_collection">The Collection</a></li>
      <li><a href="{{ route('about') }}" data-i18n="nav_about">About</a></li>
      <li><a href="{{ route('home') }}#weddings"     data-i18n="nav_weddings">Weddings</a></li>
      <li><a href="{{ route('home') }}#island"      data-i18n="nav_island">Korčula</a></li>
      <li><a href="{{ route('home') }}#contact"  data-i18n="nav_contact">Contact</a></li>
    @endif
  </ul>

  {{-- Right: language toggle desktop, hamburger mobile --}}
  <div class="nav-right">
    <div class="nav-lang-inline">
      <button class="lang-btn active" onclick="setLang('en')">EN</button>
    </div>
    {{-- Mobile hamburger --}}
    <button id="mobileMenuBtn" aria-label="Open menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: #f0e8d8;">
        <line x1="4" y1="8" x2="20" y2="8"></line>
        <line x1="4" y1="16" x2="20" y2="16"></line>
      </svg>
    </button>
  </div>

</nav>


