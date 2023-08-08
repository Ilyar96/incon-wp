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
$id = 'case-gallery-block' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-gallery-block';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

$title = esc_html__(get_field('case_gallery_title'));
$text = wp_kses_post(get_field('case_gallery_text'));
$gallery = get_field('case_gallery');
?>
<section class="case-block case-block--result">
	<div class="case-block__container">
		<?php if ($title) echo '<h2 class="case-block__title title">' . $title . '</h2>';
		if ($text) { ?>
			<div class="case-block__content editor-block">
				<div class="case-block__result"><?php echo $text ?></div>
			</div>
		<?php } ?>
	</div>

	<?php if ($gallery) { ?>
		<div class="case-block__gallery" data-gallery>
			<?php
			foreach ($gallery as $item) {
				$img = esc_url(wp_get_attachment_image_url($item['img'], 'medium'));
				$video = $item['video'];
				$ytb_link = $video['ytb_video_link'];

				if ($img) {
					if ($ytb_link) {
						$poster = $video['poster'];
						$text = esc_html__($video['text']);

						if (!$poster) {
							$poster = esc_url('https://img.youtube.com/vi/' . $ytb_link . '/0.jpg');
						}
			?>
						<a href="https://www.youtube.com/embed/<?php echo $ytb_link ?>" class="case-block__link-ibg" data-lg-size="1280-720" data-poster="<?php echo $poster ?>">
							<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="">

							<div class="case-block__video-info">
								<?php if ($text) echo '<div class="case-block__video-text">' . $text . '</div>'; ?>
							</div>
						</a>
					<?php } else { ?>
						<a href="<?php echo $img ?>" class="case-block__link-ibg">
							<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="">
						</a>
			<?php }
				}
			} ?>
		</div>
	<?php } ?>
</section>