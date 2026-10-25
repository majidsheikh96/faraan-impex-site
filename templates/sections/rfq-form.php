<?php
/** Shared RFQ form. Expects $rfqId (id prefix); optional $rfqFull (adds quantity + tech-pack upload). */
$rfqFull = $rfqFull ?? false;
$divisionOptions = ['Motorcycle racing & track gear', 'Technical textiles & flannels', 'Western heritage & headwear', 'Biker vests & leather goods'];
?>
<form data-rfq method="post" action="/contact-us#rfq-result" enctype="multipart/form-data" class="form-card" style="flex:1.2 1 460px;min-width:0">
  <input type="hidden" name="token" value="<?= e(rfq_token()) ?>">
  <div class="hp" aria-hidden="true"><label>Website <input type="text" name="company_website" tabindex="-1" autocomplete="off"></label></div>
  <div class="form-row">
    <div class="field"><label for="<?= $rfqId ?>-name">Full name</label><input id="<?= $rfqId ?>-name" name="name" type="text" required autocomplete="name"></div>
    <div class="field"><label for="<?= $rfqId ?>-email">Business email</label><input id="<?= $rfqId ?>-email" name="email" type="email" required autocomplete="email"></div>
  </div>
  <div class="form-row">
    <div class="field"><label for="<?= $rfqId ?>-co">Company or brand</label><input id="<?= $rfqId ?>-co" name="company" type="text" autocomplete="organization"></div>
    <div class="field"><label for="<?= $rfqId ?>-div">Manufacturing division</label>
      <select id="<?= $rfqId ?>-div" name="division"><?php foreach ($divisionOptions as $o): ?><option><?= e($o) ?></option><?php endforeach; ?></select></div>
  </div>
  <?php if ($rfqFull): ?>
  <div class="form-row">
    <div class="field"><label for="<?= $rfqId ?>-qty">Target quantity per style</label><input id="<?= $rfqId ?>-qty" name="quantity" type="text"></div>
    <div class="field"><label for="<?= $rfqId ?>-file">Tech pack or reference images</label><input id="<?= $rfqId ?>-file" name="techpack" type="file" accept=".pdf,.jpg,.jpeg,.png,.zip,.doc,.docx,.xls,.xlsx"></div>
  </div>
  <?php endif; ?>
  <div class="field"><label for="<?= $rfqId ?>-scope"><?= $rfqFull ? 'Project scope' : 'Project scope and target quantity' ?></label><textarea id="<?= $rfqId ?>-scope" name="message" rows="<?= $rfqFull ? 6 : 5 ?>" required></textarea></div>
  <button type="submit" class="btn btn-primary btn-block"><span>Send specifications to factory desk</span><?= icon_arrow(20) ?></button>
</form>
