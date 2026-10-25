<?php
/** Shown with HTTP 403 to visitors from blocked countries. Standalone page (no header/footer, no DB). */
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Not available in your region</title>
<meta name="robots" content="noindex, nofollow">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<section class="solo">
  <div class="head"><div class="brand"><b style="color:var(--paper)">FARAAN IMPEX</b></div></div>
  <div class="mid">
    <span class="eyebrow on-dark">ERROR 403 &middot; REGION RESTRICTED</span>
    <h1 class="h-display h-xl" style="max-width:900px">Not available in your region</h1>
    <p>This website is not available in your country.</p>
  </div>
  <div class="foot"><span>&copy; <?= date('Y') ?> FARAAN IMPEX</span></div>
</section>
</body>
</html>
