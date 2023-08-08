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
$id = 'case-list-block' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-list-block';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

$title = wp_kses_post(get_field('case_list_title'));
$left_list = get_field('case_list_left');
$right_list = get_field('case_list_right');
?>

<section class="case-block case-block--list">
	<div class="case-block__container">
		<?php if ($title) echo '<h2 class="case-block__title title">' . $title . '</h2>'; ?>
		<div class="case-block__content editor-block">
			<div class="case-block__grid">
				<div class="case-block__col">
					<ul>
						<?php
						foreach ($left_list  as $item) {
							echo '<li>' . wp_kses_post($item['text']) . '</li>';
						} ?>
					</ul>
				</div>
				<div class="case-block__col">
					<ul>
						<?php
						foreach ($right_list  as $item) {
							echo '<li>' . wp_kses_post($item['text']) . '</li>';
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>