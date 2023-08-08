<!-- <?php

			/**
			 * Case Intro Block Template.
			 *
			 * @param array $block The block settings and attributes.
			 * @param string $content The block inner HTML (empty).
			 * @param bool $is_preview True during AJAX preview.
			 * @param (int|string) $post_id The post ID this block is saved to.
			 */

			// Create id attribute allowing for custom "anchor" value.
			$id = 'case-gallery' . $block['id'];
			if (!empty($block['anchor'])) {
				$id = $block['anchor'];
			}

			// Create class attribute allowing for custom "className" and "align" values.
			$className = 'case-gallery';
			if (!empty($block['className'])) {
				$className .= ' ' . $block['className'];
			}
			if (!empty($block['align'])) {
				$className .= ' align' . $block['align'];
			}

			$title = esc_html(get_field('case_gallery_title'));
			$text = wp_kses_post(get_field('case_gallery_text'));
			$gallery = get_field('case_gallery');
			?>
<section class="case-block case-block--result">
	<div class="case-block__container">
		<?php if ($title) echo '<h2 class="case-block__title title">' . $title . '</h2>' ?>
		<?php
		if ($text) { ?>
			<div class="case-block__content editor-block">
				<div class="case-block__result"><?php echo $text ?></div>
			</div>
		<?php } ?>

	</div>

	<div class="case-block__gallery" data-gallery>
		<a href="img/case/01.jpg" class="case-block__link-ibg">
			<img src="img/case/01.jpg" alt="">
		</a>
		<a href="img/case/02.jpg" class="case-block__link-ibg">
			<img src="img/case/02.jpg" alt="">
		</a>
		<a href="img/case/03.jpg" class="case-block__link-ibg">
			<img src="img/case/03.jpg" alt="">
		</a>
		<a href="https://www.youtube.com/embed/6CcSJXdR4FQ" class="case-block__link-ibg" data-lg-size="1280-720" data-poster="img/home/video-block/video_block.jpg">
			<img src="img/case/04.jpg" alt="">

			<div class="case-block__video-info">
				<div class="case-block__video-text">Посмотрите видео ≈2 мин</div>
			</div>
		</a>
	</div>
</section> -->