/**
 * Faraan Impex — progressive enhancement only. Every feature below has a normal
 * link / form fallback, so the site works without this file.
 *  1. "Load more styles" without a page reload
 *  2. RFQ form submit without a page reload
 *  3. Prefetch internal pages on hover/touch so navigation feels instant
 */
(function () {
  'use strict';

  /* ---- 1. load more ------------------------------------------------- */
  document.addEventListener('click', function (e) {
    var btn = e.target.closest('[data-load-more]');
    if (!btn) return;
    var grid = document.querySelector('[data-grid]');
    if (!grid || !window.fetch) return; // fall back to the plain ?page= link
    e.preventDefault();
    if (btn.classList.contains('is-loading')) return;
    var url = new URL(btn.href, location.href);
    url.searchParams.set('partial', '1');
    btn.classList.add('is-loading');
    btn.setAttribute('aria-busy', 'true');
    fetch(url.toString(), { headers: { 'X-Requested-With': 'fetch' }, credentials: 'same-origin' })
      .then(function (r) { if (!r.ok) throw new Error(r.status); return r.json(); })
      .then(function (d) {
        var tmp = document.createElement('div');
        tmp.innerHTML = d.html;
        var first = tmp.querySelector('a');
        var cards = [].slice.call(tmp.children);
        cards.forEach(function (c, i) { c.classList.add('card-new'); c.style.animationDelay = (i % 4) * 0.06 + 's'; grid.appendChild(c); });
        // keep the address bar in step so refresh / back return the same list
        var shownUrl = new URL(btn.href, location.href); shownUrl.searchParams.delete('partial');
        history.replaceState(null, '', shownUrl.pathname + shownUrl.search);
        var count = btn.querySelector('[data-count]');
        if (count) count.textContent = d.shown + ' / ' + d.total;
        if (d.more) {
          var next = new URL(btn.href, location.href); next.searchParams.set('page', d.page + 1); next.searchParams.delete('partial');
          btn.href = next.pathname + next.search;
        } else {
          var wrap = btn.closest('[data-more-wrap]'); if (wrap) wrap.remove();
        }
        if (first) { first.focus({ preventScroll: true }); }
      })
      .catch(function () { location.href = btn.href; })
      .finally(function () { btn.classList.remove('is-loading'); btn.removeAttribute('aria-busy'); });
  });

  /* ---- 2. RFQ form --------------------------------------------------- */
  document.querySelectorAll('form[data-rfq]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      if (!window.fetch || !window.FormData) return;
      e.preventDefault();
      var submit = form.querySelector('button[type=submit]');
      var label = submit.querySelector('span');
      var original = label.textContent;
      var note = form.querySelector('.notice');
      if (note) note.remove();
      submit.disabled = true; label.textContent = 'Sending…';
      fetch('/contact-us', { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'fetch' }, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          if (d.token) { var t = form.querySelector('input[name=token]'); if (t) t.value = d.token; }
          var box = document.createElement('div');
          box.setAttribute('tabindex', '-1');
          if (d.ok) {
            box.className = 'notice ok'; box.setAttribute('role', 'status');
            box.innerHTML = '<strong>Request received.</strong> The factory desk will reply with a formal FOB quotation within two hours.';
            form.replaceWith(box);
          } else {
            box.className = 'notice err'; box.setAttribute('role', 'alert');
            box.textContent = d.error || 'Something went wrong. Please try again.';
            form.insertBefore(box, form.firstChild);
            submit.disabled = false; label.textContent = original;
          }
          box.scrollIntoView({ block: 'center', behavior: 'smooth' }); box.focus({ preventScroll: true });
        })
        .catch(function () { form.submit(); }); // no JSON back: let the browser post it normally
    });
  });

  /* ---- 3. prefetch --------------------------------------------------- */
  var conn = navigator.connection || {};
  if (conn.saveData || /2g/.test(conn.effectiveType || '')) return;
  var seen = {}, timer = null;
  function eligible(a) {
    if (!a || !a.href || a.target === '_blank' || a.hasAttribute('download')) return false;
    var u = new URL(a.href, location.href);
    if (u.origin !== location.origin || u.hash && u.pathname === location.pathname) return false;
    if (u.search || /^\/(admin|assets)\b/.test(u.pathname)) return false; // never prefetch ?lock=1, ?preview=… or admin
    return !seen[u.pathname];
  }
  function prefetch(a) {
    var u = new URL(a.href, location.href); seen[u.pathname] = 1;
    var l = document.createElement('link'); l.rel = 'prefetch'; l.href = u.pathname; l.as = 'document';
    document.head.appendChild(l);
  }
  document.addEventListener('mouseover', function (e) {
    var a = e.target.closest && e.target.closest('a');
    if (!eligible(a)) return;
    clearTimeout(timer); timer = setTimeout(function () { prefetch(a); }, 80); // hover intent
  });
  document.addEventListener('mouseout', function () { clearTimeout(timer); });
  document.addEventListener('touchstart', function (e) {
    var a = e.target.closest && e.target.closest('a');
    if (eligible(a)) prefetch(a);
  }, { passive: true });
})();
