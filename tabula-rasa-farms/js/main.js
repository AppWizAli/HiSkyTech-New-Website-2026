document.addEventListener('DOMContentLoaded', function () {

  /* ---------- preloader ---------- */
  var preloader = document.getElementById('preloader');
  window.addEventListener('load', function () {
    setTimeout(function () {
      if (preloader) preloader.classList.add('is-hidden');
    }, 500);
  });
  /* fallback in case 'load' already fired or takes too long */
  setTimeout(function () {
    if (preloader) preloader.classList.add('is-hidden');
  }, 2200);

  /* ---------- mobile nav toggle ---------- */
  var navToggle = document.getElementById('navToggle');
  var mobileMenu = document.getElementById('mobileMenu');

  if (navToggle && mobileMenu) {
    navToggle.addEventListener('click', function () {
      var isOpen = mobileMenu.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileMenu.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- generic scroll reveal (sections, cards, lines) ---------- */
  var revealEls = document.querySelectorAll('.reveal-up, .reveal-line');

  if ('IntersectionObserver' in window && revealEls.length) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(function (el) { revealObserver.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  /* hero lines reveal immediately on load, not on scroll */
  document.querySelectorAll('.hero-title .reveal-line, .hero-eyebrow, .hero-sub, .hero-actions').forEach(function (el) {
    el.classList.add('is-visible');
  });

  /* ---------- slate signature: draw on scroll into view ---------- */
  var slateBoard = document.getElementById('slateBoard');

  if (slateBoard && 'IntersectionObserver' in window) {
    var slateObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          slateBoard.classList.add('is-drawn');
          slateObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });

    slateObserver.observe(slateBoard);
  } else if (slateBoard) {
    slateBoard.classList.add('is-drawn');
  }

  /* ---------- counting numbers in practices ---------- */
  var counters = document.querySelectorAll('[data-count-to]');

  function animateCount(el) {
    var target = parseInt(el.getAttribute('data-count-to'), 10);
    var suffix = el.getAttribute('data-suffix') || '';
    var duration = 1400;
    var start = null;

    function step(timestamp) {
      if (!start) start = timestamp;
      var progress = Math.min((timestamp - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var current = Math.round(eased * target);
      el.textContent = current + suffix;
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target + suffix;
      }
    }
    requestAnimationFrame(step);
  }

  if (counters.length && 'IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.6 });

    counters.forEach(function (el) { counterObserver.observe(el); });
  }

  /* ---------- magnetic buttons ---------- */
  var magneticEls = document.querySelectorAll('[data-magnetic]');

  if (window.matchMedia('(hover: hover)').matches) {
    magneticEls.forEach(function (el) {
      el.addEventListener('mousemove', function (e) {
        var rect = el.getBoundingClientRect();
        var x = e.clientX - rect.left - rect.width / 2;
        var y = e.clientY - rect.top - rect.height / 2;
        el.style.transform = 'translate(' + (x * 0.18) + 'px, ' + (y * 0.3) + 'px)';
      });
      el.addEventListener('mouseleave', function () {
        el.style.transform = 'translate(0, 0)';
      });
    });
  }

  /* ---------- tilt on cards ---------- */
  var tiltEls = document.querySelectorAll('[data-tilt]');

  if (window.matchMedia('(hover: hover)').matches) {
    tiltEls.forEach(function (el) {
      el.addEventListener('mousemove', function (e) {
        var rect = el.getBoundingClientRect();
        var x = (e.clientX - rect.left) / rect.width - 0.5;
        var y = (e.clientY - rect.top) / rect.height - 0.5;
        el.style.transform = 'perspective(900px) rotateX(' + (y * -4) + 'deg) rotateY(' + (x * 4) + 'deg) translateY(-2px)';
      });
      el.addEventListener('mouseleave', function () {
        el.style.transform = 'perspective(900px) rotateX(0) rotateY(0) translateY(0)';
      });
    });
  }

  /* ---------- custom cursor dot ---------- */
  var cursorDot = document.getElementById('cursorDot');

  if (cursorDot && window.matchMedia('(hover: hover)').matches) {
    var mouseX = 0, mouseY = 0, curX = 0, curY = 0;

    window.addEventListener('mousemove', function (e) {
      mouseX = e.clientX;
      mouseY = e.clientY;
      cursorDot.classList.add('is-active');
    });

    document.addEventListener('mouseleave', function () {
      cursorDot.classList.remove('is-active');
    });

    function renderCursor() {
      curX += (mouseX - curX) * 0.18;
      curY += (mouseY - curY) * 0.18;
      cursorDot.style.transform = 'translate(' + curX + 'px, ' + curY + 'px) translate(-50%, -50%)';
      requestAnimationFrame(renderCursor);
    }
    renderCursor();

    document.querySelectorAll('a, button, [data-tilt]').forEach(function (el) {
      el.addEventListener('mouseenter', function () { cursorDot.classList.add('is-hover'); });
      el.addEventListener('mouseleave', function () { cursorDot.classList.remove('is-hover'); });
    });
  }

  /* ---------- scroll progress bar + header condense + back to top + hero parallax ---------- */
  var scrollProgress = document.getElementById('scrollProgress');
  var header = document.querySelector('.site-header');
  var backToTop = document.getElementById('backToTop');
  var hillFar = document.querySelector('.hero-hill--far');
  var hillNear = document.querySelector('.hero-hill--near');
  var heroIllustration = document.querySelector('.hero-illustration');

  function onScroll() {
    var scrollY = window.scrollY;
    var docHeight = document.documentElement.scrollHeight - window.innerHeight;
    var progress = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;

    if (scrollProgress) scrollProgress.style.width = progress + '%';
    if (header) header.classList.toggle('is-condensed', scrollY > 40);
    if (backToTop) backToTop.classList.toggle('is-visible', scrollY > 700);

    if (heroIllustration && scrollY < window.innerHeight) {
      var t = scrollY * 0.18;
      if (hillFar) hillFar.style.transform = 'translateY(' + (t * 0.5) + 'px)';
      if (hillNear) hillNear.style.transform = 'translateY(' + (t * 0.8) + 'px)';
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- visit form (static demo handling) ---------- */
  var visitForm = document.getElementById('visitForm');
  var formNote = document.getElementById('formNote');

  if (visitForm && formNote) {
    visitForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var name = document.getElementById('visitName').value.trim();

      formNote.textContent = name
        ? 'Thanks, ' + name + ' — we will get back to you by email shortly.'
        : 'Thanks — we will get back to you by email shortly.';
      formNote.classList.add('is-shown');

      visitForm.reset();
    });
  }

});
