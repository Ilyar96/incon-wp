<?php

/**
template name: Контакты
 */
get_header(); ?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<?php
	$is_map_display = get_field('is_display_contacts_map');
	$map_title = esc_html(get_field('contacts_map_title'));
	$map_code = get_field('kod_karty_s_konstruktora_kart_yandex');
	?>

	<section class="contacts">
		<div class="contacts__container">
			<?php get_template_part('template-parts/contacts/head_block_template'); ?>

			<div class="contacts__body">
				<?php
				get_template_part('template-parts/contacts/offices_template');
				get_template_part('template-parts/contacts/text_block_template');
				?>
				<?php if ($is_map_display && $map_title) echo '<h2 class="contacts__subtitle">' . $map_title . '</h2>'; ?>
			</div>
		</div>
		<?php if ($is_map_display && $map_code) { ?>
			<div class="contacts__container contacts__container--map">
				<div class="contacts__map"><?php echo $map_code; ?></div>
			</div>
		<?php } ?>
	</section>

	<?php
	// get_template_part('template-parts/price/price_template');
	?>

</main>
<?php
get_footer();
