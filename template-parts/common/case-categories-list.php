<div class="categories__grid">
	<?php
	$args = [
		'taxonomy'      => ['case-category'],
		'hide_empty'    => true,
		'orderby' => 'term_order'
	];

	$terms = get_terms($args);

	foreach ($terms as $term) { ?>
		<a href="<?php echo get_term_link($term->term_id) ?>" class="categories__item">
			<span class="categories__link"><?php echo esc_html__($term->name) ?></span>
			<span class="categories__count"><?php echo esc_html__($term->count) ?></span>
		</a>
	<?php } ?>
</div>