<?php

/**
 * Case Intro Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'case-intro-block' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-intro-block';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

$content = get_field('case_intro_content');
$img = get_field('case_intro_img');
$img_desk = $img['case_intro_img_desk'];
$img_mob = $img['case_intro_img_mob'];
if (!$img_desk) {
	$img_desk = $img_mob;
} ?>

<section class="case-intro">
	<div class="case-intro__container">
		<h1 class="case-intro__title title"><?php echo wp_kses_post(get_the_title()) ?></h1>

		<div class="case-intro__grid">
			<div class="case-intro__img-ibg">
				<picture>
					<source media="(max-width: 991.98px)" srcset="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-srcset="<?php echo $img_mob ?>">
					<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img_desk ?>" alt="">
				</picture>
			</div>
			<div class="case-intro__content editor-block">
				<?php
				foreach ($content as $item) {
					$title = wp_kses_post($item['title']);
					$text = wp_kses_post($item['text']);

					echo '<h3>' . $title . '</h3>';
					echo '<p>' . $text . '</p>';
				}

				$investments_text = esc_html__(get_field('case_investments_text', get_the_ID()));
				$investments_sum = esc_html__(get_field('case_investments_sum', get_the_ID()));

				if ($investments_sum) {
					echo '<h3>' . $investments_text . '</h3>';
					echo '<p>' . $investments_sum . '</p>';
				} ?>
			</div>
		</div>
	</div>
</section>