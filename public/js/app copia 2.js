document.addEventListener("DOMContentLoaded", function () {
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
  ).matches;

  // =============================================
  // Nav scroll — clase .scrolled al bajar
  // =============================================
  const nav = document.getElementById("mainNav");
  if (nav) {
    window.addEventListener(
      "scroll",
      function () {
        nav.classList.toggle("scrolled", window.pageYOffset > 60);
      },
      { passive: true }
    );
  }

  // =============================================
  // Mobile menu — IDs originales
  // =============================================
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const mobileMenu = document.getElementById("mobileMenu");
  const closeMobileMenu = document.getElementById("closeMobileMenu");

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", function () {
      mobileMenu.classList.remove("hidden");
      document.body.style.overflow = "hidden";
    });
    if (closeMobileMenu) {
      closeMobileMenu.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
        document.body.style.overflow = "";
      });
    }
    mobileMenu.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
        document.body.style.overflow = "";
      });
    });
  }

  // =============================================
  // Scroll reveal — suave y escalonado
  // =============================================
  if (!prefersReducedMotion) {
    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            setTimeout(function () {
              entry.target.classList.add("visible");
            }, 80);
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.06,
        rootMargin: "0px 0px -20px 0px",
      }
    );

    document.querySelectorAll(".reveal, .line-reveal").forEach(function (el) {
      observer.observe(el);
    });

    setTimeout(function () {
      document.querySelectorAll(".reveal, .line-reveal").forEach(function (el) {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
          el.classList.add("visible");
        }
      });
    }, 120);
  } else {
    document.querySelectorAll(".reveal, .line-reveal").forEach(function (el) {
      el.classList.add("visible");
    });
  }

  // =============================================
  // Smooth scroll
  // =============================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener("click", function (e) {
      const id = this.getAttribute("href");
      if (id === "#") return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: prefersReducedMotion ? "auto" : "smooth",
          block: "start",
        });
      }
    });
  });

  // =============================================
  // Newsletter AJAX
  // =============================================
  const newsletterForm = document.getElementById("newsletterForm");
  if (newsletterForm) {
    newsletterForm.addEventListener("submit", async function (e) {
      e.preventDefault();
      const btn = newsletterForm.querySelector('button[type="submit"]');
      const original = btn.textContent;
      btn.textContent = "Enviando…";
      btn.disabled = true;
      try {
        const res = await fetch(newsletterForm.action, {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
              .content,
            Accept: "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams(new FormData(newsletterForm)),
        });
        await res.json();
        btn.textContent = "✓ Suscrito";
        newsletterForm.reset();
        setTimeout(() => {
          btn.textContent = original;
          btn.disabled = false;
        }, 3000);
      } catch {
        btn.textContent = original;
        btn.disabled = false;
      }
    });

    // =============================================
    // Botón volver arriba
    // =============================================
    const backToTop = document.getElementById("backToTop");
    if (backToTop) {
      window.addEventListener(
        "scroll",
        function () {
          backToTop.classList.toggle("visible", window.pageYOffset > 600);
        },
        { passive: true }
      );
    }
  }

  // =============================================
  // i18n — ES / EN / DE
  // =============================================
  window.i18n = {
    es: {
      nav_collection: "La Colección",
      nav_about: "Nosotros",
      nav_weddings: "Bodas",
      nav_island: "Korčula",
      nav_contact: "Contacto",
      hero_location: "Korčula, Croacia",
      hero_title_1: "Una colección de",
      hero_title_2: "cinco siglos",
      hero_subtitle:
        "Cuatro residencias históricas en la isla de Korčula. Cada una, un capítulo habitable de la historia dálmata.",
      hero_cta: "Explorar la colección",
      hero_scroll: "Descubrir",
      about_eyebrow: "Nuestra Filosofía",
      about_title_1: "Preservar para",
      about_title_2: "habitar",
      about_text1:
        "Cada restauración es un acto de reverencia. Trabajamos con artesanos locales, utilizando técnicas centenarias y materiales de la isla, para que cada casa mantenga su alma intacta.",
      about_text2:
        "No creamos espacios para turistas. Creamos hogares para viajeros que buscan habitar la historia, aunque sea por unos días.",
      about_text3:
        "Tatjana von Griesheim-Radović, arquitecta paisajista de origen montenegrino, y Georg von Griesheim, de ascendencia alemana, nacido en Colombia y anteriormente banquero de inversiones y editor, comparten una larga pasión por las propiedades excepcionales, a menudo ubicadas en lugares históricos o de gran importancia cultural. Lo que comenzó como un interés personal se convirtió gradualmente en un proyecto profesional centrado en la cuidadosa restauración y el desarrollo de residencias singulares. Trabajar con edificios históricos requiere tiempo, dedicación y respeto por su carácter original; por lo tanto, cada proyecto es único. A través de TCG Unique Properties d.o.o. (Croacia) y TCG Sustainable Investments S.L. (España), el grupo desarrolla y gestiona una selecta cartera de propiedades residenciales de alta calidad.",
      stat_properties: "Propiedades",
      stat_centuries: "Siglos",
      stat_island: "Isla",
      wed_badge: "Acceso Privado",
      wed_title: "Bodas en Case dei Nobili",
      wed_subtitle: "Exclusivo para wedding planners y agencias de lujo",
      wed_f1_title: "Espacios Únicos",
      wed_f1_text:
        "Patios medievales, terrazas con vistas al Adriático y salones históricos para celebraciones íntimas o eventos exclusivos de hasta 80 invitados.",
      wed_f2_title: "Alojamiento Integral",
      wed_f2_text:
        "Alojamiento para la familia nupcial en nuestras propiedades históricas. Cada habitación cuenta una historia, cada amanecer es una promesa.",
      wed_f3_title: "Red de Colaboradores",
      wed_f3_text:
        "Acceso a nuestra curaduría de proveedores locales: chefs privados, floristas, fotógrafos y músicos que conocen cada rincón de nuestras casas.",
      wed_cta_note:
        "Solicite acceso a nuestro dossier exclusivo para profesionales. Respuesta en 48 horas.",
      wed_cta: "Solicitar Dossier",
      isl_eyebrow: "El Escenario",
      isl_title:
        'Korčula — <em style="color: var(--patina-light);">la isla que<br>el tiempo refinó</em>',
      isl1_title: "Historia y Patrimonio",
      isl1_text:
        "Lugar de nacimiento de Marco Polo. Siglos de cultura veneciana, bizantina y dálmata esculpidos en cada piedra.",
      isl2_title: "Gastronomía y Vino",
      isl2_text:
        "Vino blanco Pošip, Grk, marisco fresco. Korčula es uno de los mejores destinos gastronómicos de Croacia.",
      isl3_title: "Vela y el Mar",
      isl3_text:
        "Aguas cristalinas, calas escondidas y conexiones directas con Hvar, Dubrovnik y el archipiélago dálmata.",
      footer_subscribe: "Suscribirse",
    },
    en: {
      nav_collection: "Collection",
      nav_about: "About",
      nav_weddings: "Weddings",
      nav_island: "Korčula",
      nav_contact: "Contact",
      hero_location: "Korčula, Croatia",
      hero_title_1: "A collection of",
      hero_title_2: "five centuries",
      hero_subtitle:
        "Four historic residences on the island of Korčula. Each one, a liveable chapter of Dalmatian history.",
      hero_cta: "Explore the collection",
      hero_scroll: "Discover",
      about_eyebrow: "Our Philosophy",
      about_title_1: "Preserve to",
      about_title_2: "inhabit",
      about_text1:
        "Each restoration is an act of reverence. We work with local artisans, using centuries-old techniques and island materials, so that each house keeps its soul intact.",
      about_text2:
        "We do not create spaces for tourists. We create homes for travellers who seek to inhabit history, even if just for a few days.",
      stat_properties: "Properties",
      stat_centuries: "Centuries",
      stat_island: "Island",
      wed_badge: "Private Access",
      wed_title: "Weddings at Case dei Nobili",
      wed_subtitle: "Exclusive to wedding planners and luxury agencies",
      wed_f1_title: "Unique Spaces",
      wed_f1_text:
        "Medieval courtyards, terraces overlooking the Adriatic and historic halls for intimate celebrations or exclusive events of up to 80 guests.",
      wed_f2_title: "Full Accommodation",
      wed_f2_text:
        "Accommodation for the wedding party in our historic properties. Each room tells a story, every sunrise is a promise.",
      wed_f3_title: "Partner Network",
      wed_f3_text:
        "Access to our curated local suppliers: private chefs, florists, photographers and musicians who know every corner of our homes.",
      wed_cta_note:
        "Request access to our exclusive professional dossier. Response within 48 hours.",
      wed_cta: "Request Dossier",
      isl_eyebrow: "The Setting",
      isl_title:
        'Korčula — <em style="color: var(--patina-light);">the island<br>that time refined</em>',
      isl1_title: "History & Heritage",
      isl1_text:
        "Birthplace of Marco Polo. Centuries of Venetian, Byzantine and Dalmatian culture layered in every stone.",
      isl2_title: "Gastronomy & Wine",
      isl2_text:
        "Pošip white wine, Grk, fresh seafood. Korčula is one of Croatia's finest culinary destinations.",
      isl3_title: "Sailing & the Sea",
      isl3_text:
        "Crystal waters, hidden coves, and direct connections to Hvar, Dubrovnik and the Dalmatian archipelago.",
      footer_subscribe: "Subscribe",
    },
    de: {
      nav_collection: "Kollektion",
      nav_about: "Über uns",
      nav_weddings: "Hochzeiten",
      nav_island: "Korčula",
      nav_contact: "Kontakt",
      hero_location: "Korčula, Kroatien",
      hero_title_1: "Eine Sammlung von",
      hero_title_2: "fünf Jahrhunderten",
      hero_subtitle:
        "Vier historische Residenzen auf der Insel Korčula. Jede ein bewohnbares Kapitel der dalmatinischen Geschichte.",
      hero_cta: "Kollektion entdecken",
      hero_scroll: "Entdecken",
      about_eyebrow: "Unsere Philosophie",
      about_title_1: "Bewahren um",
      about_title_2: "zu bewohnen",
      about_text1:
        "Jede Restaurierung ist ein Akt der Ehrerbietung. Wir arbeiten mit lokalen Handwerkern und verwenden jahrhundertealte Techniken und Inselmaterialien, damit jedes Haus seine Seele bewahrt.",
      about_text2:
        "Wir schaffen keine Räume für Touristen. Wir schaffen Häuser für Reisende, die Geschichte bewohnen wollen, wenn auch nur für ein paar Tage.",
      stat_properties: "Objekte",
      stat_centuries: "Jahrhunderte",
      stat_island: "Insel",
      wed_badge: "Privater Zugang",
      wed_title: "Hochzeiten bei Case dei Nobili",
      wed_subtitle: "Exklusiv für Wedding Planner und Luxusagenturen",
      wed_f1_title: "Einzigartige Räume",
      wed_f1_text:
        "Mittelalterliche Innenhöfe, Terrassen mit Blick auf die Adria und historische Säle für intime Feiern oder exklusive Events mit bis zu 80 Gästen.",
      wed_f2_title: "Vollständige Unterkunft",
      wed_f2_text:
        "Unterkunft für die Hochzeitsgesellschaft in unseren historischen Anwesen. Jedes Zimmer erzählt eine Geschichte, jeder Sonnenaufgang ein Versprechen.",
      wed_f3_title: "Partnernetzwerk",
      wed_f3_text:
        "Zugang zu unserem kuratierten Netzwerk lokaler Anbieter: Privatköche, Floristen, Fotografen und Musiker, die jeden Winkel unserer Häuser kennen.",
      wed_cta_note:
        "Fordern Sie Zugang zu unserem exklusiven Profidossier an. Antwort innerhalb von 48 Stunden.",
      wed_cta: "Dossier anfordern",
      isl_eyebrow: "Der Ort",
      isl_title:
        'Korčula — <em style="color: var(--patina-light);">die Insel,<br>die die Zeit verfeinerte</em>',
      isl1_title: "Geschichte & Erbe",
      isl1_text:
        "Geburtsort Marco Polos. Jahrhunderte venezianischer, byzantinischer und dalmatinischer Kultur in jeden Stein gemeißelt.",
      isl2_title: "Küche & Wein",
      isl2_text:
        "Pošip-Weißwein, Grk, frischer Fisch. Korčula ist eines der besten Genussziele Kroatiens.",
      isl3_title: "Segeln & das Meer",
      isl3_text:
        "Kristallklares Wasser, versteckte Buchten und direkte Verbindungen nach Hvar, Dubrovnik und dem dalmatinischen Archipel.",
      footer_subscribe: "Abonnieren",
    },
  };

  window.setLang = function (lang) {
    if (!window.i18n[lang]) return;
    document.querySelectorAll(".lang-btn").forEach(function (b) {
      b.classList.toggle("active", b.textContent.trim().toLowerCase() === lang);
    });
    document.querySelectorAll("[data-i18n]").forEach(function (el) {
      const key = el.getAttribute("data-i18n");
      if (window.i18n[lang][key] !== undefined) {
        el.innerHTML = window.i18n[lang][key];
      }
    });
    document.documentElement.lang = lang;
    localStorage.setItem("cdn_lang", lang);
  };

  const savedLang = localStorage.getItem("cdn_lang");
  if (savedLang && window.i18n[savedLang]) {
    window.setLang(savedLang);
  }
});
