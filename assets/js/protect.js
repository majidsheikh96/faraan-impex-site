/**
 * Faraan Impex — image protection (deterrent level).
 * Disables right-click "save image", drag-and-drop, and long-press save
 * on product images. NOTE: true screenshot prevention is technically
 * impossible — watermarks (planned) are the real protection.
 */
(function () {
  'use strict';

  // Block context menu on images
  document.addEventListener('contextmenu', function (e) {
    if (e.target.closest('img')) {
      e.preventDefault();
    }
  });

  // Block drag-and-drop of images
  document.addEventListener('dragstart', function (e) {
    if (e.target.closest('img')) {
      e.preventDefault();
    }
  });

  // Extra: make product images non-selectable via CSS class
  document.querySelectorAll('img').forEach(function (img) {
    img.setAttribute('draggable', 'false');
    img.style.userSelect = 'none';
    img.style.webkitUserSelect = 'none';
  });
})();
