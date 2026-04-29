{{-- <link rel="stylesheet" href="{{ asset('css/appFooter.css') }}?v={{ filemtime(public_path('css/appFooter.css')) }}"> --}}

<!-- FOOTER -->
<footer>
  <div>
    <div class="footer-logo">von<span>G</span>riesheim</div>
    <p class="footer-tagline" data-i18n="footer_tagline">
      Case dei Nobili is a private collection of historic residences on the island of Korčula, Croatia. Part of vonGriesheim Unique Properties.
    </p>
    <p class="footer-tagline">
      {{-- <em>VonGriesheim SL · Plaza de Cosme Adrover 2A, 07008 Palma (Spain)</em><br> --}}
      Curator: +34 616 969 596<br>
      TCG unique properties d.o.o,<br>
       Mazuranicevo šetalište 2, 21000 Split (Croatia) <br>
      OIB: HR49441064083
    </p>
  </div>
  <div>
    <div class="footer-col-title" data-i18n="footer_col1">The Collection</div>
    <ul class="footer-links">
      <li><a href="/properties/ca-serenissima" data-i18n="fp1">Ca Serenissima</a></li>
      <li><a href="/properties/palazzo-veneto" data-i18n="fp2">Palazzo Veneto</a></li>
      <li><a href="/properties/palazzino-nobile" data-i18n="fp3">Palazzino Nobile</a></li>
      <li><a href="/properties/dimora-marina">Dimora Marina</a></li>
    </ul>
  </div>
  <div>
    <div class="footer-col-title" data-i18n="footer_col2">Experiences</div>
    <ul class="footer-links">
      <li>
        <a href="{{ request()->is('/') ? '#weddings' : url('/#weddings') }}" 
           data-i18n="fe1">Weddings & Ceremonies</a>
      </li>
      <li><a href="{{ route('seo.page.weddings') }}">Destination Weddings in Korčula</a></li>
      <li><a href="{{ route('seo.page.luxury') }}">Luxury Stays in Korčula</a></li>
      <li>
        <a href="{{ request()->is('/') ? '#island' : url('/#island') }}" 
           data-i18n="fe4">Korčula Island</a>
      </li>
    </ul>
  </div>
  <div>
    <div class="footer-col-title">vonGriesheim</div>
    <ul class="footer-links">
      <li><a href="{{ route('about') }}"  data-i18n="fv1">About Us</a></li>
      <li><a href="{{ route('seo.page.historic') }}">Historic Houses in Old Town</a></li>
      <li>
        <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" 
           data-i18n="fv3">Contact</a>
      </li>
      <li><a href="{{ route('privacy') }}" data-i18n="fv4">Privacy</a></li>
      <li><a href="{{ route('terms') }}" data-i18n="fv5">Terms</a></li>
    </ul>
  </div>
  <div class="footer-bottom">
    <span data-i18n="footer_copy">© 2026 TCG Unique Properties d.o.o. All rights reserved.</span>
    <span>Case dei Nobili · Korčula · Croatia</span>
    <span class="footer-credit">Designed by <a href="https://wantdsign.com/" target="_blank" rel="noopener nofollow">Wantdsign Studio</a> & 
      <a href="http://www.byladesign.com/" target="_blank" rel="noopener nofollow">Byladesign </a></span>
  </div>
  <button id="backToTop" aria-label="Back to top" onclick="window.scrollTo({top:0, behavior:'smooth'})">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
      <line x1="12" y1="19" x2="12" y2="5"></line>
      <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
  </button>
</footer>
