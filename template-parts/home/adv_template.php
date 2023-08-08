<?php
$title = esc_html(get_field('adv_title'));
$header = get_field('adv_header');
$header_title = esc_html($header['title']);
$header_link = $header['link'];
$header_page_link = esc_url($header_link['page_link']);
$header_link_text = esc_html($header_link['text']);
$header_descr = esc_html($header['descr']);
$list = get_field('adv_list');

if ($title || $header || $list) {
?>
	<section class="advantages">
		<div class="advantages__container">
			<?php if ($title || $header || $list) { ?>
				<div class="advantages__header">
					<?php if ($title) echo '<h2 class="advantages__title title">' . $title . '</h2>' ?>
					<?php if ($header) { ?>
						<div class="advantages__info">
							<div class="advantages__navigation">
								<?php
								if ($header_title) echo '<h4 class="advantages__info-title">' . $header_title . '</h4>';
								if ($header_link || $header_page_link || $header_link_text) echo '<a href="' . $header_page_link . '" class="advantages__company-link">' . $header_link_text . '</a>'
								?>
							</div>
							<?php if ($header_descr) echo '<div class="advantages__desc">' . $header_descr . '</div>' ?>
						</div>
					<?php } ?>
				</div>
			<?php }

			if ($list) { ?>
				<ul class="advantages__items">

					<?php

					foreach ($list as  $item) {
						$icon = wp_get_attachment_image_url($item['icon'], 'thumbnail');
						$title = esc_html($item['title']);
						$descr = esc_html($item['descr']);
					?>
						<li class="advantages__item">
							<div class="advantages__icon">
								<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $icon ?>" alt="">
							</div>
							<div class="advantages__subtitle"><?php echo $title ?></div>
							<div class="advantages__text"><?php echo $descr ?></div>
						</li>
					<?php
					} ?>
				</ul>
			<?php } ?>
		</div>
	</section>
<?php } ?>