<?php
/** Homepage — assembled from section partials (design: Main.dc.html). */
$page_title = 'FARAAN IMPEX — OEM / ODM Leather Garments & Motorcycle Apparel Manufacturer, Sialkot';
$page_description = 'Direct OEM/ODM manufacturer and exporter of leather garments, motorcycle apparel, technical textiles and western wear from Sialkot, Pakistan. MOQ 50 pcs, quotes in 2 hours.';

foreach (['hero', 'trust-strip', 'divisions', 'material-lab', 'process', 'featured-styles', 'inquiry-desk'] as $section) {
    require __DIR__ . '/sections/home/' . $section . '.php';
}
