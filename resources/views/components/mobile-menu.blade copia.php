<div id="mobileMenu" class="fixed inset-0 z-40 hidden" style="background: var(--stone-light);">
  <div class="flex flex-col items-center justify-center h-full gap-8">
    <a href="{{ route('home') }}#coleccion" class="font-display text-3xl" style="color: var(--ink);">La Colección</a>
    <a href="{{ route('home') }}#historia"  class="font-display text-3xl" style="color: var(--ink);">Historia</a>
    <li><a href="{{ route('about') }}" data-i18n="nav_about">Nosotros</a></li>
    <a href="{{ route('home') }}#bodas"     class="font-display text-3xl" style="color: var(--ink);">Bodas</a>
    <a href="{{ route('home') }}#contacto"  class="font-display text-3xl" style="color: var(--ink);">Contacto</a>
    <button id="closeMobileMenu" class="mt-8 text-xs tracking-widest uppercase" style="color: var(--patina);">Cerrar</button>
  </div>
</div>
