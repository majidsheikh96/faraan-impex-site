<?php /** Proof strip — editable turnarounds from Admin > Settings, fixed factory certs. */
$_qt = get_setting('quote_turnaround', 'Under 2 hours');
$_st = get_setting('sample_turnaround', '7–10 days');
?>
<section class="proof">
  <div class="wrap">
    <div class="cell"><div class="num"><?= e($_qt) ?></div><div class="cap">Formal FOB quotation</div></div>
    <div class="cell"><div class="num"><?= e($_st) ?></div><div class="cap">To your first counter-sample</div></div>
    <div class="cell"><div class="num">OEM &middot; ODM</div><div class="cap">Private label and custom branding</div></div>
    <div class="cell"><div class="num">CE &middot; REACH</div><div class="cap">Level 2 armor, compliant materials</div></div>
  </div>
</section>
