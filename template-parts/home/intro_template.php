<!-- Intro -->
<?php
$title = wp_kses_post(get_field('intro_title'));
$subtitle = wp_kses_post(get_field('intro_subtitle'));
$link = get_field('intro_link');
$slider = get_field('intro_slider');

if ($title || $subtitle || $link || $slider) {
?>
	<section class="intro row">
		<div class="intro__col-left col">
			<?php
			if ($title) {
				echo '<h1 class="intro__title">' . $title . '</h1>';
			}
			if ($subtitle) {
				echo '<div class="intro__text">' . $subtitle  . '</div>';
			}
			if ($link) {
				$link_text = wp_kses_post($link['text']);
				$link_url = esc_url($link['link']);

				echo '<a href="' . $link_url . '" class="intro__btn btn btn--intro" type="button">' . $link_text . '</a>';
			}
			?>
		</div>
		<div class="intro__col-right col">
			<?php
			if ($slider) { ?>
				<div class="intro__slider intro-slider">
					<div class="intro-slider__swiper">
						<?php
						foreach ($slider as $slide) {
							$slider_img_id = $slide['intro_slider_img'];
							$slider_number = wp_kses_post($slide['intro_slider_number']);
							$slider_text = wp_kses_post($slide['intro_slider_text']);
							$slider_img = esc_url(wp_get_attachment_image_url($slider_img_id, 'large'));
						?>
							<div class="intro-slider__slide">
								<div class="intro-slider__img-ibg">
									<img class="swiper-lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $slider_img ?>" alt="">
								</div>
								<div class="intro-slider__content">
									<div class="intro-slider__number">
										<svg width="15rem" height="15rem">
											<circle r="7rem" cx="7.3rem" cy="7.3rem" fill="transparent" stroke="#ffffff" stroke-width="3" />
										</svg>
										<span><?php echo $slider_number ?></span>
									</div>

									<div class="intro-slider__text"><?php echo $slider_text ?></div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

		</div>
	</section><!-- /Intro -->
<?php } ?>