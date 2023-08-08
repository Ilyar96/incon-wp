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
$id = 'case-review-block' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-review-block';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

$title = esc_html__(get_field('case_review_title'));
$text = esc_html__(get_field('case_review_text'));
$sign = esc_html__(get_field('case_review_signature'));
$img_id = get_field('case_review_img');
$img_thumbnail = esc_url(wp_get_attachment_image_url($img_id, 'medium'));
$img_full = esc_url(wp_get_attachment_image_url($img_id, 'full'));
?>
<section class="review">
	<div class="review__container">
		<?php if ($title) echo '<h2 class="review__title title">' . $title . '</h2>'; ?>


		<div class="review__body">
			<div class="review__content">
				<?php
				if ($text) echo '<div class="review__text">' . $text . '</div>';
				if ($sign) echo '<div class="review__signature">' . $sign . '</div>';
				?>
			</div>
			<?php if ($img_id) { ?>
				<div class="review__img-ibg" data-gallery>
					<a href="<?php echo $img_full ?>">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img_thumbnail ?>" alt="">
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</section>