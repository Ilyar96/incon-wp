<?php
$title = esc_html(get_the_title());
$text = wp_kses_post(get_field('contacts_text'));
$phone = esc_html(get_field('contacts_phone'));
$wh_link = esc_html(get_field('contacts_whatsapp'));
$wh_icon = esc_url(get_field('contacts_whatsapp_icon'));
$tg_link = esc_html(get_field('contacts_telegram'));
$tg_icon = esc_url(get_field('contacts_telegram_icon'));
?>

<div class="contacts__header">
	<h1 class="contacts__title title"><?php echo $title ?></h1>
	<div class="contacts__links">
		<?php if ($phone) { ?>
			<div class="contacts__number">
				<a href="tel:+<?php echo preg_replace('![^0-9]+!', '', $phone) ?>" class="contacts__phone"><?php echo $phone ?></a>
				<div class="contacts__text"><?php echo $text ?></div>
			</div>
		<?php }
		if ($wh_link || $wh_link) { ?>
			<div class="contacts__socials">
				<?php if ($wh_link && $wh_icon) { ?>
					<a href="<?php echo $wh_link ?>" class="contacts__whatsapp" target="_blank">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $wh_icon ?>" alt="whatsapp">
					</a>
				<?php }
				if ($tg_link || $tg_link) {
				?>
					<a href="<?php echo $tg_link ?>" class="contacts__telegram" target="_blank">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $tg_icon ?>" alt="telegram">
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>