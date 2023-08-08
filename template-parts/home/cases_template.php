	<!-- cases -->
	<?php
	$title = wp_kses_post(get_field('cases_title'));
	$title = wp_kses_post(get_field('cases_title'));
	$subtitle = wp_kses_post(get_field('cases_subtitle'));
	$categories_title = wp_kses_post(get_field('cases_list_category'));
	$stats = get_field('cases_stats');
	$slider = get_field('cases_slider');

	if ($title || $subtitle || $stats || $slider || $list_category) { ?>
		<section class="cases">
			<div class="cases__container">
				<div class="cases__head">
					<div class="cases__head-content">
						<?php
						if ($title) {
							echo '<h2 class="cases__title title">' . $title . '</h2>';
						}
						if ($subtitle) {
							echo '<div class="cases__descr">' . $subtitle . '</div>';
						} ?>
					</div>
					<?php

					if ($stats) {
						$stats_number = $stats['number'];
						$stats_text = $stats['text'];

						echo '<div class="cases__countries">';
						if ($stats_number) {
							echo '<div class="cases__number">' . $stats_number . '</div>';
						}
						if ($stats_text) {
							echo '<div class="cases__countries-text">' . $stats_text . '</div>';
						}
						echo '</div>';
					} ?>
				</div>
			</div>

			<?php
			if ($slider) { ?>
				<div id="cases-galery" class="cases__body">
					<div class="cases__swiper">
						<?php
						foreach ($slider as $index => $slide) {
							$video = esc_url($slide['bgr_video']);
							$ytb_video_link = esc_html__($slide['video_link']);
							$text = wp_kses_post($slide['text']);
							$btn_text = wp_kses_post($slide['btn_text']);
							$poster = esc_url($slide['case_poster']);
							$case_category_link = get_term_link((int) $slide['case_category'], 'case-category');
							$hidden_class = "";
							if (!$poster) {
								$poster = esc_url('https://img.youtube.com/vi/' . $ytb_video_link . '/0.jpg');
							}
							if ($index > 0) {
								$hidden_class = "_hidden";
							} ?>
							<div class="cases__slide row <?php echo $hidden_class ?>">
								<div class="cases__col-video col" data-lg-size="1280-720" data-src="https://www.youtube.com/embed/<?php echo $ytb_video_link ?>" data-poster="<?php echo $poster ?>">
									<video class="cases__video swiper-lazy" data-src="<?php echo $video ?>" autoplay muted loop></video>
								</div>
								<div class=" cases__col-content col">
									<div class="cases__text"><?php echo $text ?></div>
									<a href="<?php echo $case_category_link ?>" class="cases__link btn btn--outline"><?php echo $btn_text ?></a>
								</div>
							</div>
						<?php
						}
						?>
					</div>
					<div class="cases__navigation">
						<button class="cases__btn-prev" type="button">Предыдущий слайд</button>
						<button class="cases__btn-next" type="button">Следующий слайд</button>
					</div>
				</div>
			<?php } ?>
		</section>
	<?php } ?>
	<!-- /cases -->


	<!-- Categories -->
	<section class="categories">
		<div class="categories__container">
			<?php
			if ($categories_title) {
				echo '<h2 class="categories__title">' . $categories_title . '</h2>';
			}
			get_template_part('template-parts/common/case-categories-list');
			?>

		</div>
	</section>
	<!-- /Categories -->