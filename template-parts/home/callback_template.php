<?php
$is_display = get_field('is_display_home_contatcs');
$title = esc_html(get_field('home_contacts_title'));
$subtitle = wp_kses_post(get_field('home_contacts_subtitle'));

if ($is_display) {
?>
	<section class="callback">
		<div class="callback__container">
			<?php
			if ($title) echo '<h2 class="callback__title title">' . $title . '</h2>';
			if ($subtitle) echo '<div class="callback__info">' . $subtitle . '</div>';
			get_template_part('template-parts/common/callback_form');
			?>
		</div>
	</section>
<?php } ?>