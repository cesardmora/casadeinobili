/**
 * Case dei Nobili — Main JavaScript
 */
document.addEventListener('DOMContentLoaded', function () {

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // =============================================
  // Navigation scroll effect
  // =============================================
  const nav = document.getElementById('mainNav');

  if (nav) {
    window.addEventListener('scroll', function () {
      if (window.pageYOffset > 100) {
        nav.classList.add('nav-scrolled');
      } else {
        nav.classList.remove('nav-scrolled');
      }
    }, { passive: true });
  }

  // =============================================
  // Mobile menu
  // =============================================
  const mobileMenuBtn  = document.getElementById('mobileMenuBtn');
  const mobileMenu     = document.getElementById('mobileMenu');
  const closeMobileMenu = document.getElementById('closeMobileMenu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', function () {
      mobileMenu.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });

    if (closeMobileMenu) {
      closeMobileMenu.addEventListener('click', closeMobileMenuFn);
    }

    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeMobileMenuFn);
    });
  }

  function closeMobileMenuFn() {
    mobileMenu.classList.add('hidden');
    document.body.style.overflow = '';
  }

  // =============================================
  // Scroll reveal — IntersectionObserver
  // =============================================
  if (!prefersReducedMotion) {
    const revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.reveal, .line-reveal').forEach(function (el) {
      revealObserver.observe(el);
    });

  } else {
    document.querySelectorAll('.reveal').forEach(function (el) {
      el.classList.add('visible');
    });
    document.querySelectorAll('.line-reveal').forEach(function (el) {
      el.classList.add('visible');
    });
  }

  // =============================================
  // Smooth scroll for anchor links
  // =============================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;

      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: prefersReducedMotion ? 'auto' : 'smooth',
          block: 'start'
        });
      }
    });
  });

  // =============================================
  // Newsletter form — AJAX submission
  // =============================================
  const newsletterForm = document.getElementById('newsletterForm');

  if (newsletterForm) {
    newsletterForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(newsletterForm);
      const btn = newsletterForm.querySelector('button[type="submit"]');
      const originalText = btn.textContent;

      btn.textContent = 'Enviando…';
      btn.disabled = true;

      try {
        const response = await fetch(newsletterForm.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams(formData),
        });

        const data = await response.json();
        btn.textContent = '✓ Suscrito';
        newsletterForm.reset();

        setTimeout(function () {
          btn.textContent = originalText;
          btn.disabled = false;
        }, 3000);

      } catch (err) {
        btn.textContent = 'Error, inténtelo de nuevo';
        btn.disabled = false;
        setTimeout(function () { btn.textContent = originalText; }, 3000);
      }
    });
  }

  // =============================================
  // Hero subtle parallax
  // =============================================
  if (!prefersReducedMotion) {
    const heroSection = document.querySelector('.hero-section');

    if (heroSection) {
      window.addEventListener('scroll', function () {
        const scrolled = window.pageYOffset;
        if (scrolled < heroSection.offsetHeight) {
          heroSection.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
      }, { passive: true });
    }
  }

});
