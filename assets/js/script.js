document.addEventListener("DOMContentLoaded", () => {
  /* --- 1. Menu Burger (Existant + Animation toggle) --- */
  const burger = document.querySelector(".burger");
  const nav = document.querySelector(".nav-links");

  if (burger) {
    burger.addEventListener("click", () => {
      nav.classList.toggle("active");
      // Animation simple de l'icône burger
      burger.classList.toggle("fa-bars");
      burger.classList.toggle("fa-times");
    });
  }

  /* --- 2. Animation Header au Scroll --- */
  const header = document.querySelector("header");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });

  /* --- 3. Reveal Animations on Scroll (Intersection Observer) --- */
  const revealElements = document.querySelectorAll(".reveal");

  const revealObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active");
          observer.unobserve(entry.target); // Animation ne joue qu'une fois
        }
      });
    },
    {
      root: null,
      threshold: 0.15, // Déclenche quand 15% de l'élément est visible
      rootMargin: "0px 0px -50px 0px",
    }
  );

  revealElements.forEach((el) => {
    revealObserver.observe(el);
  });

  /* --- 4. Petit effet smooth pour les liens ancres --- */
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute("href")).scrollIntoView({
        behavior: "smooth",
      });
    });
  });
});




















/* --- 5. Système de Carousels Multiples (Boucle Infinie) --- */

// On sélectionne tous les wrappers de carousel présents sur la page
const carousels = document.querySelectorAll('.carousel-wrapper');

if (carousels.length > 0) {
    
    // Fonction d'initialisation pour CHAQUE carousel individuellement
    const initCarousel = (wrapper) => {
        const track = wrapper.querySelector('.carousel-track');
        const container = wrapper.querySelector('.carousel-track-container');
        const nextButton = wrapper.querySelector('.next-btn');
        const prevButton = wrapper.querySelector('.prev-btn');
        // On cherche la navigation (points) à l'extérieur du wrapper immédiat parfois, 
        // ou on suppose qu'elle est frère du wrapper. 
        // Dans ton HTML index.php, .carousel-nav est frère de .carousel-wrapper.
        // On remonte au parent (.container) pour trouver le .carousel-nav associé
        const dotsNav = wrapper.parentElement.querySelector('.carousel-nav');
        
        if (!track || !container) return;

        // Convertir les slides en Array
        let slides = Array.from(track.children);
        const originalSlideCount = slides.length;

        // --- CLONAGE (Début & Fin) ---
        const firstClones = slides.map(slide => slide.cloneNode(true));
        const lastClones = slides.map(slide => slide.cloneNode(true));

        lastClones.forEach(clone => {
            clone.classList.add('clone');
            track.insertBefore(clone, track.firstChild);
        });
        firstClones.forEach(clone => {
            clone.classList.add('clone');
            track.appendChild(clone);
        });

        // Re-sélectionner tous les slides (originaux + clones)
        let allSlides = Array.from(track.children);
        let index = originalSlideCount; // On commence après les clones de gauche
        let slideWidth;

        // --- MISE À JOUR DIMENSIONS ---
        const updateDimensions = () => {
            const visibleSlides = window.innerWidth >= 1000 ? 3 : (window.innerWidth >= 700 ? 2 : 1);
            const containerWidth = container.getBoundingClientRect().width;
            slideWidth = containerWidth / visibleSlides;

            allSlides.forEach(slide => {
                slide.style.minWidth = slideWidth + 'px';
                slide.style.width = slideWidth + 'px';
            });

            // Recalage silencieux (sans transition)
            track.style.transition = 'none';
            track.style.transform = `translateX(${-slideWidth * index}px)`;
        };

        // --- MOUVEMENT ---
        const moveSlide = () => {
            track.style.transition = 'transform 0.5s ease-in-out';
            track.style.transform = `translateX(${-slideWidth * index}px)`;
            if(dotsNav) updateDots();
        };

        // --- GESTION BOUCLE INFINIE (TransitionEnd) ---
        track.addEventListener('transitionend', () => {
            // Trop à droite (sur clones de fin) -> retour début réel
            if (index >= allSlides.length - originalSlideCount) {
                track.style.transition = 'none';
                index = originalSlideCount;
                track.style.transform = `translateX(${-slideWidth * index}px)`;
            }
            // Trop à gauche (sur clones de début) -> retour fin réelle
            if (index < originalSlideCount) {
                track.style.transition = 'none';
                index = allSlides.length - (originalSlideCount * 2);
                track.style.transform = `translateX(${-slideWidth * index}px)`;
            }
        });

        // --- MISE À JOUR POINTS ---
        const updateDots = () => {
            if (!dotsNav) return;
            
            let realIndex = (index - originalSlideCount) % originalSlideCount;
            if (realIndex < 0) realIndex += originalSlideCount;

            // Correction limites transition
            if(index >= allSlides.length - originalSlideCount) realIndex = 0;
            if(index < originalSlideCount) realIndex = originalSlideCount - 1;

            const currentDot = dotsNav.querySelector('.current-slide');
            const targetDot = dotsNav.children[realIndex];
            
            if (currentDot) currentDot.classList.remove('current-slide');
            if (targetDot) targetDot.classList.add('current-slide');
        };

        // --- EVENTS ---

        // Resize
        window.addEventListener('resize', updateDimensions);
        // Init immédiat
        updateDimensions();

        // Next
        if (nextButton) {
            nextButton.addEventListener('click', () => {
                if (index >= allSlides.length - (window.innerWidth >= 1000 ? 3 : 1)) return; 
                index++;
                moveSlide();
            });
        }

        // Prev
        if (prevButton) {
            prevButton.addEventListener('click', () => {
                if (index <= 0) return; 
                index--;
                moveSlide();
            });
        }

        // Click Points
        if (dotsNav) {
            const dots = Array.from(dotsNav.children);
            dotsNav.addEventListener('click', e => {
                const targetDot = e.target.closest('button');
                if (!targetDot) return;
                
                const targetIndex = dots.findIndex(dot => dot === targetDot);
                index = targetIndex + originalSlideCount;
                moveSlide();
            });
        }

        // --- SWIPE TACTILE ---
        let touchStartX = 0;
        let touchEndX = 0;

        track.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});

        track.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchEndX < touchStartX - 50) {
                index++;
                moveSlide();
            }
            if (touchEndX > touchStartX + 50) {
                index--;
                moveSlide();
            }
        }, {passive: true});
    };

    // Lancer la boucle sur chaque carousel trouvé
    carousels.forEach(carouselWrapper => initCarousel(carouselWrapper));
}