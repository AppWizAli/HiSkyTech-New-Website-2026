 document.querySelectorAll('.custom-phone-dropdown').forEach(dropdown => {
  const selected = dropdown.querySelector('.selected');
  const options = dropdown.querySelector('.dropdown-options');
  const input = dropdown.querySelector('input[type="tel"]');

  // Toggle dropdown
  selected.addEventListener('click', e => {
    e.stopPropagation(); // prevent document click from closing
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
  });

  // Select an option
  options.querySelectorAll('li').forEach(li => {
    li.addEventListener('click', e => {
      e.stopPropagation();
      selected.innerHTML = li.innerHTML; // update selected display
      options.style.display = 'none';
    });
  });
});

// Close dropdown if clicked outside
document.addEventListener('click', () => {
  document.querySelectorAll('.custom-phone-dropdown .dropdown-options').forEach(d => {
    d.style.display = 'none';
  });
});


// ..............


   document.querySelectorAll('.custom-select').forEach(select => {
  const selected = select.querySelector('.selected-option');
  const optionsContainer = select.querySelector('.options');
  const hiddenInput = select.querySelector('input[type="hidden"]');

  // Toggle dropdown
  selected.addEventListener('click', e => {
    e.stopPropagation();
    optionsContainer.style.display = optionsContainer.style.display === 'block' ? 'none' : 'block';
  });

  // Select an option
  optionsContainer.querySelectorAll('li').forEach(option => {
    option.addEventListener('click', e => {
      selected.textContent = option.textContent;
      hiddenInput.value = option.dataset.value; // store actual value
      optionsContainer.style.display = 'none';
    });
  });
});

// Close dropdown if clicked outside
document.addEventListener('click', () => {
  document.querySelectorAll('.custom-select .options').forEach(o => o.style.display = 'none');
});

// .......................

  document.querySelectorAll('.job-dropdown').forEach(dropdown => {
  const selected = dropdown.querySelector('.job-selected');
  const options = dropdown.querySelector('.job-options');
  const hiddenInput = dropdown.querySelector('input[type="hidden"]');

  // Toggle dropdown
  selected.addEventListener('click', e => {
    e.stopPropagation();
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
  });

  // Select an option
  options.querySelectorAll('li').forEach(option => {
    option.addEventListener('click', () => {
      selected.textContent = option.textContent;
      hiddenInput.value = option.dataset.value;
      options.style.display = 'none';
    });
  });
});

// Close dropdown when clicking outside
document.addEventListener('click', () => {
  document.querySelectorAll('.job-options').forEach(o => o.style.display = 'none');
});


// ........................... 
document.addEventListener("DOMContentLoaded", () => {

  /* =====================
     SIDEBAR
  ====================== */
  const sidebar = document.getElementById('sidebar');
  const openBtn = document.getElementById('openSidebarBtn');
  const closeBtn = document.getElementById('closeSidebarBtn');
  const overlay = document.getElementById('sidebarOverlay');

  if (openBtn && sidebar) {
    openBtn.addEventListener('click', () => {
      document.body.classList.add('sidebar-open');
    });
  }

  function closeSidebar() {
    document.body.classList.remove('sidebar-open');
  }

  if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
  if (overlay) overlay.addEventListener('click', closeSidebar);

  /* =====================
     MOBILE MENU
  ====================== */
  const hamburger = document.querySelector('.sidebar__toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('menu-open');
    });
  }

  /* =====================
     MOBILE DROPDOWNS
  ====================== */
  document.querySelectorAll('#mobile-menu li.has-dropdown > a')
    .forEach(anchor => {
      anchor.addEventListener('click', e => {
        if (window.innerWidth <= 992) {
          e.preventDefault();
          anchor.parentElement.classList.toggle('menu-open');
        }
      });
    });

});




// ............................................ 
document.addEventListener('DOMContentLoaded', function () {

  const swiperEl = document.querySelector('.industries-swiper');

  // Make sure swiper exists before using it
  if (swiperEl) {
    const slides = swiperEl.querySelectorAll('.swiper-slide').length;

    const loopMode = slides > 1 ? true : false; // only loop if more than 1 slide

    const swiper = new Swiper('.industries-swiper', {
      slidesPerView: 1.2,
      spaceBetween: 20,
      centeredSlides: true,
      loop: loopMode,
      autoplay: { delay: 2500, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      breakpoints: {
        576: { slidesPerView: 1.3, spaceBetween: 15 },
        768: { slidesPerView: 2, spaceBetween: 25 },
        992: { slidesPerView: 3, spaceBetween: 30 },
      },
    });
  }

});



// ....................................................... 

const cards = document.querySelectorAll('.service-card');
const details = document.querySelectorAll('.service-left');

/* INITIAL STATE */
details.forEach((d, index) => {
  d.style.transition = 'opacity 0.4s ease, transform 0.4s ease';

  if (index === 0) {
    // 👇 show first item by default
    d.style.display = 'block';
    d.style.opacity = 1;
    d.style.transform = 'translateY(0)';
  } else {
    d.style.display = 'none';
    d.style.opacity = 0;
    d.style.transform = 'translateY(15px)';
  }
});

/* CLICK HANDLER */
cards.forEach(card => {
  card.addEventListener('click', () => {
    const service = card.getAttribute('data-service');

    /* ACTIVE CARD */
    cards.forEach(c => c.classList.remove('active'));
    card.classList.add('active');

    /* HIDE ALL DETAILS */
    details.forEach(d => {
      d.style.opacity = 0;
      d.style.transform = 'translateY(15px)';

      setTimeout(() => {
        d.style.display = 'none';
      }, 300);
    });

    /* SHOW SELECTED DETAIL */
    const activeDetail = document.querySelector(
      `.service-left[data-service-detail="${service}"]`
    );

    setTimeout(() => {
      activeDetail.style.display = 'block';

      requestAnimationFrame(() => {
        activeDetail.style.opacity = 1;
        activeDetail.style.transform = 'translateY(0)';
      });
    }, 300);
  });
});



// ............................................................ 

const teamSwiper = new Swiper(".team-swiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: { slidesPerView: 1 },
    768: { slidesPerView: 2 },
    1200: { slidesPerView: 2 },
  },
});


const heroSwiper = new Swiper(".hero-swiper", {
    slidesPerView: 1,
    loop: true,
    effect: "fade",
    speed: 1000,            // <-- fade transition duration (1 second)
    fadeEffect: {
        crossFade: true     // smooth crossfade
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    on: {
        slideChangeTransitionStart: function () {
            // Remove animation classes from previous slide
            const slides = document.querySelectorAll(".hero-swiper .swiper-slide");
            slides.forEach(slide => {
                slide.querySelectorAll(".wow").forEach(el => {
                    el.classList.remove("animate__fadeInUp");
                });
            });
        },
        slideChangeTransitionEnd: function () {
            // Add animation classes to active slide
            const activeSlide = this.slides[this.activeIndex];
            activeSlide.querySelectorAll(".wow").forEach(el => {
                el.classList.add("animate__fadeInUp");
            });
        },
    },
});

document.addEventListener("DOMContentLoaded", () => {

  const exploreButton = document.querySelector(".explore-careers");
  const heroSection = document.querySelector(".hero-section");

  if (!exploreButton || !heroSection) return;

  function updateExploreButton() {
    const heroBottom = heroSection.getBoundingClientRect().bottom;

    if (heroBottom > 0) {
      // Hero visible → transparent/white
      exploreButton.classList.remove("solid");
    } else {
      // Hero passed → solid blue
      exploreButton.classList.add("solid");
    }
  }

  // Run immediately (important)
  updateExploreButton();

  // Run on scroll
  window.addEventListener("scroll", updateExploreButton);
});




// ................................................................................................... 

document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".custom-phone-dropdown").forEach(wrapper => {

    const input = wrapper.querySelector("input[type='tel']");
    const dropdown = wrapper.querySelector(".dropdown-options");

    if (!input || !dropdown) return; // safety check

    // Init intl-tel-input
    const iti = window.intlTelInput(input, {
      separateDialCode: true,
      initialCountry: "pk",
      utilsScript:
        "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
    });

    // Open dropdown on input focus
    input.addEventListener("focus", () => {
      wrapper.classList.add("active");
    });

    // Select country
    dropdown.querySelectorAll("li").forEach(item => {
      item.addEventListener("click", () => {
        if (item.dataset.iso) {
          iti.setCountry(item.dataset.iso);
        }
        wrapper.classList.remove("active");
        input.focus();
      });
    });

    // Close only THIS dropdown
    document.addEventListener("click", e => {
      if (!wrapper.contains(e.target)) {
        wrapper.classList.remove("active");
      }
    });

  });

});


// ................................................. 


document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".header-main .main-menu ul li");

    menuItems.forEach(item => {
        const submenu = item.querySelector(".submenu, .has-homemenu");
        const link = item.querySelector("a");

        if (submenu && link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();

                // Close others
                menuItems.forEach(i => {
                    if (i !== item) i.classList.remove("menu-open");
                });

                // Toggle current
                item.classList.toggle("menu-open");
            });

            // Close dropdown after clicking any link inside submenu
            const subLinks = submenu.querySelectorAll("a");
            subLinks.forEach(sublink => {
                sublink.addEventListener("click", function () {
                    item.classList.remove("menu-open");
                });
            });
        }
    });

    // Close on outside click
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".header-main")) {
            menuItems.forEach(item => item.classList.remove("menu-open"));
        }
    });
});

// ........................................................ 
document.querySelectorAll('.ajax-contact-form').forEach(form => {
  const messagesDiv = form.querySelector('.form-messages');
  if (!messagesDiv) {
    // if no div, create it dynamically
    const div = document.createElement('div');
    div.classList.add('form-messages');
    form.appendChild(div);
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const messages = form.querySelector('.form-messages');
    messages.textContent = '';
    messages.style.color = 'red';

    // Services validation
    const checkboxes = form.querySelectorAll('input[name="services[]"]');
    if (checkboxes.length && !Array.from(checkboxes).some(cb => cb.checked)) {
      messages.textContent = 'Please select at least one service.';
      return;
    }

    // Prepare form data
    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      body: formData
    })
    .then(async res => {
      if (!res.ok) {
        const text = await res.text();
        throw new Error(text || 'Something went wrong.');
      }
      return res.text();
    })
    .then(data => {
      messages.textContent = data;
      messages.style.color = 'green';
      form.reset();
    })
    .catch(err => {
      messages.textContent = err.message;
    });
  });
});





// ....................................................................... /


document.querySelectorAll('.scroll-link').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();

    const targetId = this.getAttribute('href').substring(1);
    const target = document.getElementById(targetId);

    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});


// ............................................................ 


  
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".insight-card").forEach(card => {
    card.style.cursor = "pointer";
    card.addEventListener("click", function () {
      const link = this.getAttribute("data-link");
      if (link) window.location.href = link;
    });
  });
});

// ....................................................................... 


  
document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('click', () => {

        const serviceKey = card.getAttribute('data-service');
        const slug = card.getAttribute('data-slug');

        // Toggle content
        document.querySelectorAll('.service-left').forEach(detail => {
            detail.style.display =
                detail.dataset.serviceDetail === serviceKey ? 'block' : 'none';
        });

        // Update Read More link
        document.getElementById('serviceReadMore').href =
            'service/' + slug;
    });
});


// ............................................................. 

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".insight-card").forEach(card => {
    card.style.cursor = "pointer";

    card.addEventListener("click", function () {
      const link = this.getAttribute("data-link");
      if (link) {
        window.location.href = link;
      }
    });
  });
});


// ................................................................... 


// document.getElementById("contactForm").addEventListener("submit", function(e) {
//     e.preventDefault();

//     const form = this;
//     const formData = new FormData(form);

//     fetch(form.action, {
//         method: "POST",
//         body: formData,
//         headers: {
//             "X-Requested-With": "XMLHttpRequest"
//         }
//     })
//     .then(res => res.text())
//     .then(data => {
//         if (data.trim() === "success") {
//             // ✅ redirect after success
//             window.location.href = "index.php";
//         } else {
//             alert(data);
//         }
//     })
//     .catch(err => {
//         alert("Something went wrong. Please try again.");
//         console.error(err);
//     });
// });


// ......................................... 

document.addEventListener("DOMContentLoaded", function() {
  // Handle all scroll links
  document.querySelectorAll(".scroll-link").forEach(link => {
    link.addEventListener("click", function(e) {
      e.preventDefault();
      const hash = this.getAttribute("href");

      // Check if section exists on current page
      const target = document.querySelector(hash);
      if (target) {
        // Smooth scroll
        target.scrollIntoView({ behavior: "smooth", block: "start" });
      } else {
        // Section not on this page → redirect to homepage with hash
        window.location.href = "<?= BASE_URL ?>" + hash;
      }
    });
  });

  // Animate on scroll
  const elements = document.querySelectorAll('.animate-on-scroll');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active'); // trigger animation
        observer.unobserve(entry.target); // optional
      }
    });
  }, { threshold: 0.3 });
  elements.forEach(el => observer.observe(el));

  // WOW.js init
  new WOW().init();
});



document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".scroll-link").forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const hash = this.getAttribute("href");
      if (!hash || !hash.startsWith("#")) return;

      const target = document.querySelector(hash);

      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
      } else {
        window.location.href = window.BASE_URL + hash;
      }
    });
  });
});
