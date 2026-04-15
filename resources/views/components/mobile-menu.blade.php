<div id="mobileMenu" class="fixed inset-0 z-40 hidden" style="background: rgba(13,31,40,0.99);">
   <div class="flex flex-col items-center justify-center h-full gap-8">

     @if(request()->routeIs('home'))
       <a href="#collection" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_collection">The Collection</a>

       <a href="{{ route('about') }}" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_about">About</a>

       <a href="#weddings" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_weddings">Weddings</a>

       <a href="#island" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_island">Korčula</a>

       <a href="#contact" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_contact">Contact</a>
     @else
       <a href="{{ route('home') }}#collection" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_collection">The Collection</a>

       <a href="{{ route('about') }}" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_about">About</a>

       <a href="{{ route('home') }}#weddings" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_weddings">Weddings</a>

       <a href="{{ route('home') }}#island" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_island">Korčula</a>

       <a href="{{ route('home') }}#contact" class="font-display text-3xl" style="color: #f0e8d8;"
          data-i18n="nav_contact">Contact</a>
     @endif

     <div style="display:flex; gap:0; margin-top:1rem;">
      <button class="lang-btn active" onclick="setLang('en')">EN</button>
    </div>

     <button id="closeMobileMenu" class="mt-4 text-xs tracking-widest uppercase"
             style="color: #b8933a; background:none; border:1px solid rgba(184,147,58,0.4); padding:0.6rem 2rem; cursor:pointer;">
       Close
     </button>

   </div>
 </div>
