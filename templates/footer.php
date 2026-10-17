</main>

<!-- Footer -->
<footer class="bg-[#0A0A0A] text-[#FAF7F2]/85 mt-16">
  <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-4 gap-10">
    <div class="md:col-span-2">
      <div class="text-xl font-extrabold text-[#FAF7F2] mb-3">FARAAN <span class="text-[#E10600]">IMPEX</span></div>
      <p class="text-sm leading-relaxed max-w-md">Standing on the grounds of quality, Faraan Impex offers stylish leather and textile wears from Sialkot, Pakistan to international markets worldwide.</p>
    </div>
    <div>
      <div class="font-semibold text-[#FAF7F2] mb-3">Quick Links</div>
      <ul class="space-y-2 text-sm">
        <?php foreach (get_top_categories() as $cat): ?>
          <li><a href="/<?= e($cat['slug']) ?>/" class="hover:text-[#E10600]"><?= e($cat['name']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="/about-us" class="hover:text-[#E10600]">About Us</a></li>
        <li><a href="/contact-us" class="hover:text-[#E10600]">Contact Us</a></li>
      </ul>
    </div>
    <div>
      <div class="font-semibold text-[#FAF7F2] mb-3">Contact</div>
      <ul class="space-y-2 text-sm">
        <li><?= e(CONTACT_ADDRESS) ?></li>
        <li><a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="hover:text-[#E10600]"><?= e(CONTACT_EMAIL) ?></a></li>
        <li><a href="tel:<?= e(str_replace(' ', '', CONTACT_PHONE)) ?>" class="hover:text-[#E10600]"><?= e(CONTACT_PHONE) ?></a></li>
        <li><?= e(CONTACT_PHONE_2) ?></li>
      </ul>
      <a href="<?= whatsapp_link("Assalam-o-Alaikum, I'd like to enquire about your products.") ?>" target="_blank" rel="noopener" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded font-medium text-sm">Chat on WhatsApp</a>
    </div>
  </div>
  <div class="border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 py-4 text-xs text-[#FAF7F2]/50 flex justify-between">
      <span>&copy; <?= date('Y') ?> Faraan Impex. All rights reserved.</span>
      <span>Sialkot, Pakistan</span>
    </div>
  </div>
</footer>

<?php if (IMAGE_PROTECTION): ?>
<script src="/assets/js/protect.js"></script>
<?php endif; ?>
</body>
</html>
