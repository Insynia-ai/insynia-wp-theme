/**
 * Insynia — main.js
 *
 * Core site-wide JS. Keep this file small; feature-specific behavior
 * belongs in its own file enqueued by a feature module under inc/features/.
 */

(function () {
	'use strict';

	/**
	 * Mobile navigation toggle.
	 */
	function initNavToggle() {
		var toggle = document.querySelector('.nav-toggle');
		var nav    = document.getElementById('site-navigation');
		if (!toggle || !nav) return;

		toggle.addEventListener('click', function () {
			var expanded = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!expanded));
			nav.classList.toggle('is-open', !expanded);
		});

		// Close menu on Escape
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
				toggle.setAttribute('aria-expanded', 'false');
				nav.classList.remove('is-open');
				toggle.focus();
			}
		});
	}

	/**
	 * Mark current year placeholders (e.g. <span data-current-year>).
	 */
	function initCurrentYear() {
		var targets = document.querySelectorAll('[data-current-year]');
		if (!targets.length) return;
		var year = String(new Date().getFullYear());
		targets.forEach(function (el) { el.textContent = year; });
	}

	/**
	 * Initialize on DOM ready.
	 */
	function ready(fn) {
		if (document.readyState !== 'loading') {
			fn();
		} else {
			document.addEventListener('DOMContentLoaded', fn);
		}
	}

	ready(function () {
		initNavToggle();
		initCurrentYear();
	});

	/**
	 * Public API exposed on window.Insynia for feature modules to extend.
	 */
	window.Insynia = window.Insynia || {};
	window.Insynia.ready = ready;
})();
