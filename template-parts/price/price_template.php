<?php
$title = esc_html(get_field('price_title'));
$left_col = wp_kses_post(get_field('price_col_left'));
$right_col = wp_kses_post(get_field('price_col_right'));
?>

<section class="price">
	<div class="price__container">
		<?php if ($title) echo '<h1 class="price__title title">' . $title . '</h1>';
		if ($left_col || $right_col) {
		?>
			<div class="price__row">
				<?php
				if ($left_col) echo '<div class="price__col">' . $left_col . '</div>';
				if ($right_col) echo '<div class="price__col">' . $right_col . '</div>';
				?>
			</div>
		<?php } ?>
	</div>
</section>