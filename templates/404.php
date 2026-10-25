<?php $page_title = 'Page not found | FARAAN IMPEX'; ?>
<section class="wrap" style="padding-top:88px;padding-bottom:104px;display:flex;flex-direction:column;gap:24px;align-items:flex-start">
  <span class="eyebrow">ERROR 404 &middot; PAGE NOT FOUND</span>
  <div class="big-code">404</div>
  <h2 class="h-display h-lg">That style isn&rsquo;t in the catalog</h2>
  <p class="lede" style="margin:0;max-width:520px">The page may have moved or the link may be wrong. Head back to the homepage, browse a division, or send us what you&rsquo;re looking for.</p>
  <div class="hero-ctas">
    <a class="btn btn-primary" href="/">Back to homepage</a>
    <a class="btn btn-ghost" href="/contact-us">Request a quote</a>
  </div>
  <div class="chips" style="margin-top:16px">
    <?php foreach (get_top_categories() as $c): ?><a class="chip" href="/<?= e($c['slug']) ?>/"><?= e($c['name']) ?></a><?php endforeach; ?>
  </div>
</section>
