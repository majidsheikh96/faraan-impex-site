-- Point homepage hero slides + division cards at the client-supplied images (assets/images/client/).
-- Safe to run once on a DB that already has hero_slides_json / divisions_json saved from the admin.
UPDATE site_settings SET setting_value = JSON_SET(setting_value,
  '$[0].image', '/assets/images/client/hero-rider.jpg',
  '$[1].image', '/assets/images/client/hero-flannel.jpg',
  '$[2].image', '/assets/images/client/hero-hat.jpg',
  '$[3].image', '/assets/images/client/hero-vest.jpg') WHERE setting_key = 'hero_slides_json';
UPDATE site_settings SET setting_value = JSON_SET(setting_value,
  '$[0].image', '/assets/images/client/card-racing.jpg',
  '$[1].image', '/assets/images/client/card-flannel.jpg',
  '$[2].image', '/assets/images/client/card-hat.jpg',
  '$[3].image', '/assets/images/client/card-vest.jpg') WHERE setting_key = 'divisions_json';
