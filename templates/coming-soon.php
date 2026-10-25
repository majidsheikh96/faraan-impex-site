<?php
/**
 * Faraan Impex — Luxury Atelier "Coming Soon" & VIP Staging Portal.
 * Dark luxury aesthetic matching Stagfield Sports caliber.
 */
declare(strict_types=1);

$siteName = get_setting('site_name', 'Faraan Impex');
$badge = get_setting('coming_soon_badge', 'PRODUCTION FACILITY ACTIVE · SIALKOT FACTORY FLOOR OPERATIONAL');
$title = get_setting('coming_soon_title', 'Crafting the New Standard in OEM & Private-Label Manufacturing');
$lead = get_setting('coming_soon_lead', 'Our digital wholesale portal is undergoing scheduled platform deployment. Factory production lines, physical counter-sample development, and bespoke private-label orders remain in full operation.');
$moq = get_site_moq();
$sampleTurnaround = get_setting('sample_turnaround', '7–10 Business Days');
$quoteTurnaround = get_setting('quote_turnaround', 'Under 2 Hours');
$contactEmail = get_setting('contact_email', 'faraanimpex@gmail.com');
$contactPhone = get_setting('contact_phone', '+92 332 7464484');
$whatsappNumber = get_setting('whatsapp_number', '923327464484');
$address = get_setting('contact_address', 'P.O. 10/94, Nekapura Road, Sialkot 51310, Pakistan');
$secretKey = get_setting('coming_soon_key', 'faraan');
$hasError = !empty($GLOBALS['coming_soon_error']);
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-[#070709] text-white antialiased">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($siteName) ?> — Luxury Leather &amp; Technical Garments Manufacturer | Launching Soon</title>
<meta name="description" content="<?= e($lead) ?>">
<meta name="robots" content="noindex, nofollow">

<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        crimson: "#C51E28",
        "crimson-hover": "#A81822",
        obsidian: "#070709",
        surface: "#0F1015"
      },
      fontFamily: {
        sans: ["Inter", "system-ui", "sans-serif"],
        headline: ["Georgia", "Times New Roman", "serif"],
        mono: ["Space Mono", "monospace"]
      }
    }
  }
}
</script>

<style>
.subtle-grid {
  background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
  background-size: 28px 28px;
}
</style>
</head>
<body class="min-h-full flex flex-col justify-between relative overflow-x-hidden selection:bg-crimson selection:text-white subtle-grid">

  <!-- Ambient Luxury Spotlight Glow -->
  <div class="pointer-events-none fixed inset-0 overflow-hidden -z-10">
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[720px] h-[480px] bg-gradient-to-b from-[#C51E28]/15 via-red-900/5 to-transparent blur-[140px] rounded-full"></div>
    <div class="absolute -bottom-40 right-10 w-[500px] h-[400px] bg-gradient-to-t from-[#141522]/40 to-transparent blur-[120px] rounded-full"></div>
  </div>

  <!-- Header Navigation Bar -->
  <header class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 flex items-center justify-between border-b border-white/5">
    <a href="/" class="flex items-center group">
      <img src="/assets/images/logo.png" alt="<?= e($siteName) ?>" class="h-9 sm:h-11 w-auto object-contain transition-transform group-hover:scale-[1.02]">
    </a>

    <!-- Live Operational Beacon Badge -->
    <div class="hidden sm:inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-[11px] font-mono text-white/80">
      <span class="relative flex h-2 w-2">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
      </span>
      <span><?= e($badge) ?></span>
    </div>

    <!-- VIP / Staff Trigger -->
    <div>
      <button type="button" 
              onclick="document.getElementById('vip-modal').classList.remove('hidden')" 
              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 text-white/80 hover:text-white text-xs font-mono transition-colors">
        <span class="material-symbols-outlined text-[15px]">lock</span>
        <span>VIP Access</span>
      </button>
    </div>
  </header>

  <!-- Mobile Live Operational Beacon Badge -->
  <div class="sm:hidden px-4 pt-4 text-center">
    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/[0.03] border border-white/10 text-[10px] font-mono text-white/80">
      <span class="relative flex h-2 w-2">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
      </span>
      <span><?= e($badge) ?></span>
    </div>
  </div>

  <!-- Main Hero Stage -->
  <main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 flex-1 flex flex-col justify-center text-center">
    
    <!-- Editorial Kicker -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-crimson/10 border border-crimson/25 text-crimson text-xs font-mono font-bold uppercase tracking-[0.2em] mx-auto mb-6">
      <span>SIALKOT FACTORY · DIRECT OEM / ODM ATELIER</span>
    </div>

    <!-- Georgia Headline -->
    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-headline font-bold text-white tracking-tight leading-[1.15] max-w-4xl mx-auto mb-6">
      <?= e($title) ?>
    </h1>

    <!-- Narrative Lead -->
    <p class="text-base sm:text-lg text-white/70 font-sans font-light leading-relaxed max-w-2xl mx-auto mb-10">
      <?= e($lead) ?>
    </p>

    <!-- Urgent Inquiry & Factory Contact Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mb-16">
      <a href="https://wa.me/<?= e($whatsappNumber) ?>?text=<?= rawurlencode("Assalam-o-Alaikum, I am inquiring about wholesale OEM/ODM contract production with Faraan Impex.") ?>" 
         target="_blank" rel="noopener noreferrer"
         class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-mono text-xs font-bold uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-lg shadow-emerald-950/40 transition-all hover:-translate-y-0.5">
        <span class="material-symbols-outlined text-[18px]">chat</span>
        <span>Factory WhatsApp Concierge</span>
      </a>

      <a href="mailto:<?= e($contactEmail) ?>?subject=Wholesale%20OEM%20Manufacturing%20Enquiry" 
         class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-white/10 hover:bg-white/15 border border-white/15 text-white font-mono text-xs font-bold uppercase tracking-wider px-6 py-3.5 rounded-xl transition-all hover:-translate-y-0.5">
        <span class="material-symbols-outlined text-[18px]">mail</span>
        <span>Submit Tech Pack / RFQ</span>
      </a>

      <a href="tel:<?= e($contactPhone) ?>" 
         class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-transparent hover:bg-white/5 border border-white/10 text-white/80 hover:text-white font-mono text-xs font-bold uppercase tracking-wider px-5 py-3.5 rounded-xl transition-all">
        <span class="material-symbols-outlined text-[18px]">call</span>
        <span><?= e($contactPhone) ?></span>
      </a>
    </div>

    <!-- 4 Pillar Manufacturing Capability Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-left">
      
      <div class="bg-surface/80 border border-white/10 rounded-2xl p-5 hover:border-crimson/50 transition-colors">
        <span class="text-xs font-mono font-bold text-crimson block mb-2">01 / MOTORCYCLE</span>
        <h2 class="text-base font-bold text-white mb-1.5">Racing Apparel &amp; Gear</h2>
        <p class="text-xs text-white/60 leading-relaxed">
          CE-certified full-grain cowhide leather race suits, armored jackets, and technical riding cordura.
        </p>
      </div>

      <div class="bg-surface/80 border border-white/10 rounded-2xl p-5 hover:border-crimson/50 transition-colors">
        <span class="text-xs font-mono font-bold text-crimson block mb-2">02 / TEXTILE WEARS</span>
        <h2 class="text-base font-bold text-white mb-1.5">Technical Flannels</h2>
        <p class="text-xs text-white/60 leading-relaxed">
          Heavyweight yarn-dyed cotton flannels reinforced with abrasion-resistant aramid protective linings.
        </p>
      </div>

      <div class="bg-surface/80 border border-white/10 rounded-2xl p-5 hover:border-crimson/50 transition-colors">
        <span class="text-xs font-mono font-bold text-crimson block mb-2">03 / WESTERN WEARS</span>
        <h2 class="text-base font-bold text-white mb-1.5">Artisan Headwear</h2>
        <p class="text-xs text-white/60 leading-relaxed">
          100% Australian wool felt cowboy hats, distress suede crowns, custom brass conchos &amp; brim shaping.
        </p>
      </div>

      <div class="bg-surface/80 border border-white/10 rounded-2xl p-5 hover:border-crimson/50 transition-colors">
        <span class="text-xs font-mono font-bold text-crimson block mb-2">04 / COMMERCIAL B2B</span>
        <h2 class="text-base font-bold text-white mb-1.5">Production SLAs</h2>
        <p class="text-xs text-white/60 leading-relaxed">
          MOQ: <strong class="text-white"><?= e($moq) ?></strong><br>
          Counter-Samples: <span class="text-white/90"><?= e($sampleTurnaround) ?></span><br>
          RFQ Response: <span class="text-white/90"><?= e($quoteTurnaround) ?></span>
        </p>
      </div>

    </div>

  </main>

  <!-- VIP Passcode Unlock Modal -->
  <div id="vip-modal" class="<?= $hasError ? '' : 'hidden' ?> fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="bg-[#0F1015] border border-white/15 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-2xl relative">
      <button type="button" 
              onclick="document.getElementById('vip-modal').classList.add('hidden')" 
              class="absolute top-4 right-4 text-white/40 hover:text-white transition-colors">
        <span class="material-symbols-outlined">close</span>
      </button>

      <div class="flex items-center gap-2 mb-2">
        <span class="material-symbols-outlined text-crimson">lock_open</span>
        <h3 class="text-base font-bold font-mono uppercase tracking-wider text-white">VIP Client &amp; Staff Access</h3>
      </div>
      <p class="text-xs text-white/60 mb-5 leading-relaxed">
        Enter your preview passcode or click the bypass URL parameter to explore the full wholesale catalog.
      </p>

      <?php if ($hasError): ?>
        <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 px-3.5 py-2.5 rounded-xl text-xs font-mono mb-4 flex items-center gap-2">
          <span class="material-symbols-outlined text-sm">error</span>
          <span><?= e($GLOBALS['coming_soon_error']) ?></span>
        </div>
      <?php endif; ?>

      <form method="get" action="/" class="space-y-4">
        <div>
          <label class="block text-[11px] font-mono uppercase tracking-wider text-white/70 mb-1.5">Passcode</label>
          <input type="text" name="preview" value="<?= e($hasError ? '' : $secretKey) ?>" required autofocus
                 placeholder="e.g. <?= e($secretKey) ?>"
                 class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-2.5 text-sm font-mono text-white placeholder-white/30 focus:outline-none focus:border-crimson">
        </div>

        <div class="flex items-center gap-3">
          <button type="submit" class="flex-1 bg-crimson hover:bg-crimson-hover text-white text-xs font-mono font-bold uppercase tracking-wider py-3 rounded-xl transition-colors">
            Unlock Full Website →
          </button>
        </div>
      </form>

      <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between text-[11px] font-mono text-white/40">
        <span>Passcode: <code class="text-white/80"><?= e($secretKey) ?></code></span>
        <a href="/admin/index.php" class="text-white/70 hover:text-white underline">Admin Login</a>
      </div>
    </div>
  </div>

  <!-- Footer Coordinates -->
  <footer class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-t border-white/5 text-xs font-mono text-white/40 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
    <div>
      <?= e($address) ?>
    </div>
    <div class="flex items-center gap-4">
      <span>&copy; <?= date('Y') ?> <?= e(strtoupper($siteName)) ?></span>
      <span>·</span>
      <a href="/admin/index.php" class="hover:text-white transition-colors">Staff Login</a>
    </div>
  </footer>

</body>
</html>
