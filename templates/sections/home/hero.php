<?php
/**
 * Hero Stage — Editorial Multi-Category Slider (Stagfield Luxury Caliber)
 * Balanced Luxury Height (~670px desktop) — Fully visible above-the-fold on 13"-16" screens.
 * 100% Dynamic Admin-Controlled Slides — Zero AI-generated stock imagery.
 * Rock-solid CSS Grid layer stacking — Zero height jump / zero layout shift during transitions.
 */

$rawSlides = get_hero_slides_data();
$heroSlides = [];
foreach ($rawSlides as $i => $s) {
    $heroSlides[] = [
        'id'            => 'slide-' . ($i + 1),
        'kicker'        => $s['kicker'] ?? '',
        'title'         => $s['title'] ?? '',
        'lead'          => $s['lead'] ?? '',
        'pills'         => $s['pills'] ?? [],
        'image'         => $s['image'] ?? '',
        'image_pos'     => 'object-cover ' . ($s['image_pos'] ?? 'object-center'),
        'tab_label'     => $s['tab_label'] ?? ('Slide ' . ($i + 1)),
        'primary_cta'   => ['text' => $s['primary_cta_text'] ?? 'Explore Division', 'href' => $s['primary_cta_url'] ?? '/contact-us'],
        'secondary_cta' => ['text' => $s['secondary_cta_text'] ?? 'Start an RFQ', 'href' => $s['secondary_cta_url'] ?? '/contact-us']
    ];
}
?>

<!-- 1. HERO STAGE — BALANCED EDITORIAL MULTI-CATEGORY SLIDER -->
<section id="hero-slider" class="relative min-h-[580px] sm:min-h-[620px] lg:min-h-[670px] lg:max-h-[720px] flex items-center overflow-hidden bg-[#070709] text-white select-none" aria-label="Manufacturing Disciplines Showcase">
  
  <!-- Slide Layers Container -->
  <div class="absolute inset-0 z-0">
    <?php foreach ($heroSlides as $idx => $slide): ?>
      <div class="hero-slide-layer absolute inset-0 transition-opacity duration-1000 ease-in-out <?= $idx === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' ?>" 
           data-slide-index="<?= $idx ?>">
        
        <!-- High-Resolution Widescreen Photography (2560x1440 Master) -->
        <img src="<?= e($slide['image']) ?>" 
             alt="<?= e(strip_tags($slide['title'])) ?>" 
             class="hero-slide-img w-full h-full <?= e($slide['image_pos']) ?> transition-transform duration-[6000ms] ease-out <?= $idx === 0 ? 'scale-100' : 'scale-105' ?>" 
             <?= $idx === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?> 
             decoding="async">
        
        <!-- Deep Obsidian Chiaroscuro Atmospheric Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#070709] via-[#070709]/95 sm:via-[#070709]/85 sm:via-55% to-[#070709]/30 lg:to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#070709] via-transparent to-transparent opacity-80"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#070709]/50 via-transparent to-transparent opacity-60"></div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Hero Content Stage (CSS Grid Stacking — Balanced Proportions) -->
  <div class="relative z-10 w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 pt-20 pb-24 sm:pt-24 sm:pb-28 lg:pt-28 lg:pb-28">
    <div class="grid grid-cols-1 grid-rows-1 max-w-2xl lg:max-w-[780px] w-full">
      
      <?php foreach ($heroSlides as $idx => $slide): ?>
        <div class="hero-slide-content col-start-1 row-start-1 w-full transition-all duration-700 ease-out <?= $idx === 0 ? 'opacity-100 translate-y-0 pointer-events-auto z-10' : 'opacity-0 translate-y-3 pointer-events-none z-0' ?>" 
             data-slide-content="<?= $idx ?>">
          
          <!-- Eyebrow Kicker -->
          <div class="inline-flex items-center gap-2 mb-4">
            <span class="w-2 h-2 rounded-full bg-crimson animate-pulse"></span>
            <span class="font-sans text-[11px] sm:text-[11.5px] uppercase font-bold tracking-[0.2em] text-crimson">
              <?= e($slide['kicker']) ?>
            </span>
          </div>

          <!-- Monumental Headline in Georgia Serif (Balanced 52px-58px scale) -->
          <h1 class="font-serif text-3xl sm:text-5xl lg:text-[52px] xl:text-[58px] font-bold text-white tracking-[-0.03em] leading-[1.12] mb-5">
            <?= $slide['title'] ?>
          </h1>

          <!-- Subheading -->
          <p class="font-body text-[14.5px] sm:text-base lg:text-[16.5px] text-[#D9E0E6] font-normal leading-[1.6] mb-7 max-w-xl">
            <?= e($slide['lead']) ?>
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 mb-7">
            <a href="<?= e($slide['primary_cta']['href']) ?>" 
               class="inline-flex items-center justify-center bg-crimson hover:bg-crimson-hover text-white font-sans font-bold text-[13.5px] tracking-wide px-7 py-3.5 rounded-full transition-all duration-200 shadow-lg shadow-crimson/25 active:scale-[0.98] text-center">
              <span><?= e($slide['primary_cta']['text']) ?></span>
            </a>
            <a href="<?= e($slide['secondary_cta']['href']) ?>" 
               class="inline-flex items-center justify-center border border-white/25 hover:border-white bg-white/[0.05] hover:bg-white/[0.12] text-white font-sans font-bold text-[13.5px] tracking-wide px-6 py-3.5 rounded-full transition-all duration-200 text-center">
              <span><?= e($slide['secondary_cta']['text']) ?></span>
            </a>
          </div>

          <!-- Slide Specific Spec Badges -->
          <div class="pt-5 border-t border-white/10 flex flex-wrap items-center gap-2">
            <span class="font-mono text-[10.5px] text-white/50 uppercase tracking-widest mr-1.5 hidden sm:inline">Pillars:</span>
            <?php foreach ($slide['pills'] as $pill): ?>
              <span class="px-2.5 py-1 rounded-full bg-white/[0.07] border border-white/10 text-white/85 font-mono text-[10.5px]">
                <?= e($pill) ?>
              </span>
            <?php endforeach; ?>
          </div>

        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <!-- Bottom Interactive Category Bar & Controls -->
  <div class="absolute bottom-0 inset-x-0 z-20 bg-gradient-to-t from-[#070709] via-[#070709]/80 to-transparent pb-5 pt-8">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
      
      <!-- Interactive Category Tabs with Animated Progress -->
      <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto max-w-full pb-1 md:pb-0 scrollbar-none" role="tablist">
        <?php foreach ($heroSlides as $idx => $slide): ?>
          <button type="button" 
                  class="hero-tab-btn group relative px-3.5 py-1.5 rounded-full border transition-all duration-300 text-left shrink-0 <?= $idx === 0 ? 'bg-white/15 border-white/30 text-white' : 'bg-black/30 border-white/10 text-white/60 hover:text-white hover:border-white/20' ?>" 
                  data-tab-index="<?= $idx ?>"
                  role="tab"
                  aria-selected="<?= $idx === 0 ? 'true' : 'false' ?>">
            
            <div class="flex items-center gap-2">
              <span class="font-mono text-[10px] <?= $idx === 0 ? 'text-crimson' : 'text-white/40 group-hover:text-crimson' ?> font-bold transition-colors">
                0<?= $idx + 1 ?>
              </span>
              <span class="font-sans text-[11.5px] font-medium tracking-wide">
                <?= e($slide['tab_label']) ?>
              </span>
            </div>

            <!-- Animated Progress Line for Active Tab -->
            <div class="hero-progress-track absolute bottom-0 left-3 right-3 h-[2px] bg-white/10 rounded-full overflow-hidden mt-0.5 <?= $idx === 0 ? 'block' : 'hidden' ?>">
              <div class="hero-progress-fill h-full bg-crimson w-0 transition-all duration-100 ease-linear"></div>
            </div>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Arrow Navigation & Slide Indicator -->
      <div class="flex items-center gap-2.5 shrink-0 self-end md:self-auto">
        <span class="font-mono text-[11px] text-white/50 tracking-widest mr-2">
          <strong id="hero-current-slide" class="text-white font-bold">01</strong> / 0<?= count($heroSlides) ?>
        </span>

        <button type="button" 
                id="hero-prev-btn" 
                class="w-8 h-8 rounded-full border border-white/20 bg-white/5 hover:bg-white/15 hover:border-white text-white flex items-center justify-center transition-all duration-200 active:scale-95" 
                aria-label="Previous Slide">
          <span class="text-xs font-bold font-mono">←</span>
        </button>

        <button type="button" 
                id="hero-next-btn" 
                class="w-8 h-8 rounded-full border border-white/20 bg-white/5 hover:bg-white/15 hover:border-white text-white flex items-center justify-center transition-all duration-200 active:scale-95" 
                aria-label="Next Slide">
          <span class="text-xs font-bold font-mono">→</span>
        </button>
      </div>

    </div>
  </div>

</section>

<!-- Lightweight Vanilla JS Slider Controller with Zero Reflow/Zero Height Jump -->
<script>
(function() {
  const slider = document.getElementById('hero-slider');
  if (!slider) return;

  const slideLayers = slider.querySelectorAll('.hero-slide-layer');
  const slideContents = slider.querySelectorAll('.hero-slide-content');
  const tabBtns = slider.querySelectorAll('.hero-tab-btn');
  const counterEl = document.getElementById('hero-current-slide');
  const prevBtn = document.getElementById('hero-prev-btn');
  const nextBtn = document.getElementById('hero-next-btn');

  const totalSlides = slideLayers.length;
  let currentIndex = 0;
  let autoPlayTimer = null;
  let progressTimer = null;
  const slideDuration = 5500;
  let progressStart = Date.now();
  let isPaused = false;

  function setSlide(index) {
    if (index === currentIndex) return;
    
    index = (index + totalSlides) % totalSlides;
    currentIndex = index;

    // 1. Update background layers
    slideLayers.forEach((layer, i) => {
      const img = layer.querySelector('.hero-slide-img');
      if (i === currentIndex) {
        layer.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
        layer.classList.add('opacity-100', 'z-10');
        if (img) {
          img.classList.remove('scale-105');
          img.classList.add('scale-100');
        }
      } else {
        layer.classList.remove('opacity-100', 'z-10');
        layer.classList.add('opacity-0', 'z-0', 'pointer-events-none');
        if (img) {
          img.classList.remove('scale-100');
          img.classList.add('scale-105');
        }
      }
    });

    // 2. Update typography content instantly via CSS Grid stack (zero height jump)
    slideContents.forEach((content, i) => {
      if (i === currentIndex) {
        content.classList.remove('opacity-0', 'translate-y-3', 'pointer-events-none', 'z-0');
        content.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto', 'z-10');
      } else {
        content.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto', 'z-10');
        content.classList.add('opacity-0', 'translate-y-3', 'pointer-events-none', 'z-0');
      }
    });

    // 3. Update tabs & progress
    tabBtns.forEach((btn, i) => {
      const track = btn.querySelector('.hero-progress-track');
      const fill = btn.querySelector('.hero-progress-fill');
      const num = btn.querySelector('.font-mono');
      
      if (i === currentIndex) {
        btn.classList.remove('bg-black/30', 'border-white/10', 'text-white/60');
        btn.classList.add('bg-white/15', 'border-white/30', 'text-white');
        btn.setAttribute('aria-selected', 'true');
        if (num) {
          num.classList.remove('text-white/40');
          num.classList.add('text-crimson');
        }
        if (track) track.classList.remove('hidden');
        if (fill) fill.style.width = '0%';
      } else {
        btn.classList.remove('bg-white/15', 'border-white/30', 'text-white');
        btn.classList.add('bg-black/30', 'border-white/10', 'text-white/60');
        btn.setAttribute('aria-selected', 'false');
        if (num) {
          num.classList.remove('text-crimson');
          num.classList.add('text-white/40');
        }
        if (track) track.classList.add('hidden');
        if (fill) fill.style.width = '0%';
      }
    });

    // 4. Update numeric counter
    if (counterEl) {
      counterEl.textContent = '0' + (currentIndex + 1);
    }

    restartAutoPlay();
  }

  function nextSlide() {
    setSlide(currentIndex + 1);
  }

  function prevSlide() {
    setSlide(currentIndex - 1);
  }

  function restartAutoPlay() {
    clearInterval(autoPlayTimer);
    clearInterval(progressTimer);

    if (isPaused) return;

    progressStart = Date.now();
    const currentTab = tabBtns[currentIndex];
    const fill = currentTab ? currentTab.querySelector('.hero-progress-fill') : null;

    progressTimer = setInterval(() => {
      if (isPaused) return;
      const elapsed = Date.now() - progressStart;
      const pct = Math.min(100, (elapsed / slideDuration) * 100);
      if (fill) fill.style.width = pct + '%';
    }, 50);

    autoPlayTimer = setTimeout(() => {
      nextSlide();
    }, slideDuration);
  }

  // Event Listeners
  if (nextBtn) nextBtn.addEventListener('click', nextSlide);
  if (prevBtn) prevBtn.addEventListener('click', prevSlide);

  tabBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      const idx = parseInt(btn.getAttribute('data-tab-index'), 10);
      setSlide(idx);
    });
  });

  slider.addEventListener('mouseenter', () => {
    isPaused = true;
    clearInterval(autoPlayTimer);
    clearInterval(progressTimer);
  });

  slider.addEventListener('mouseleave', () => {
    isPaused = false;
    restartAutoPlay();
  });

  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') nextSlide();
    if (e.key === 'ArrowLeft') prevSlide();
  });

  let touchStartX = 0;
  let touchEndX = 0;
  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    if (touchStartX - touchEndX > 50) nextSlide();
    if (touchEndX - touchStartX > 50) prevSlide();
  }, { passive: true });

  restartAutoPlay();
})();
</script>
