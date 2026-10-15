/* VI Studio Travel CRM — public website behaviour. No dependencies; every feature degrades gracefully without it. */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Header gets a glass background once the page scrolls.
    var header = document.querySelector('[data-header]');
    function onScroll() {
        if (header) {
            header.classList.toggle('is-scrolled', window.scrollY > 12);
        }
    }
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    // Mobile menu.
    var toggle = document.querySelector('[data-nav-toggle]');
    var nav = document.querySelector('[data-nav]');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        nav.addEventListener('click', function (event) {
            if (event.target.closest('a')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }

    // Reveal-on-scroll.
    var items = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && !reduceMotion) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        items.forEach(function (item) { observer.observe(item); });
    } else {
        items.forEach(function (item) { item.classList.add('is-in'); });
    }

    // Demo form: bring the first error into view and stop double submissions.
    var errors = document.getElementById('demo-errors');
    if (errors) {
        errors.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' });
    }

    document.querySelectorAll('[data-demo-form]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            var button = form.querySelector('[data-submit]');
            if (!form.checkValidity()) {
                event.preventDefault();
                form.reportValidity();
                return;
            }
            if (button) {
                button.disabled = true;
                var label = button.querySelector('span');
                if (label) { label.textContent = 'Sending…'; }
            }
        });
    });
}());
