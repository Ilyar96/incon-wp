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
$id = 'case-more-block' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-more-block';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

$title = wp_kses_post(get_field('case_more_title'));
$text = wp_kses_post(get_field('case_more_text'));
$btn_open = wp_kses_post(get_field('case_btn_open'));
$btn_close = wp_kses_post(get_field('case_btn_close'));
?>

<section class="case-block">
	<div class="case-block__container">
		<?php
		if ($title) { ?>
			<h2 class="case-block__title title"><?php echo $title ?></h2>
		<?php } ?>
		<div class="case-block__content editor-block" data-read-more>
			<div class="case-block__text">
				<p><?php echo $text ?></p>
			</div>
			<button class="case-block__btn" type="button" data-close-text="<?php echo $btn_open ?>" data-open-text="<?php echo $btn_close ?>"><?php echo $btn_open ?></button>
		</div>
	</div>
</section>