<?php
$title = esc_html(get_the_title());
$left_col = wp_kses_post(get_field('about_intro_left'));
$right_col = wp_kses_post(get_field('about_intro_right'));
?>

<section class="case-block case-block--about">
	<div class="case-block__container">
		<?php if ($title) echo '<h1 class="case-block__title title">' . $title . '</h1>'; ?>
		<div class="case-block__content editor-block">
			<div class="case-block__grid">
				<?php if ($left_col) echo '<div class="case-block__col">' . $left_col . '</div>'; ?>
				<?php if ($right_col) echo '<div class="case-block__col">' . $right_col . '</div>'; ?>
			</div>
		</div>
	</div>
</section>