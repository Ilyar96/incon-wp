<?php
$is_display = get_field('is_display_price_contatcs');
$title = esc_html(get_field('price_cb_title'));
$subtitle = wp_kses_post(get_field('price_cb_subtitle'));

if ($is_display) {
?>
	<section class="callback callback--price">
		<div class="callback__container">
			<?php
			if ($title) echo '<h2 class="callback__title title">' . $title . '</h2>';
			if ($subtitle) echo '<div class="callback__info">' . $subtitle . '</div>';
			get_template_part('template-parts/common/callback_form');
			?>
		</div>
	</section>
<?php } ?>