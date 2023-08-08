<?php
$title = esc_html(get_field('team_title'));
$prev_btn = esc_html(get_field('team_prev_slide_btn'));
$next_btn = esc_html(get_field('team_next_slide_btn'));
$slider = get_field('team_slider');

if ($slider) {
?>

	<section class="team">
		<div class="team__container">
			<div class="team__header">
				<?php if ($prev_btn || $next_btn) { ?>
					<div class="team__navigation">
						<?php
						if ($prev_btn) echo '<button class="team__btn-prev" type="button">' . $prev_btn . '</button>';
						if ($next_btn) echo '<button class="team__btn-next" type="button">' . $next_btn . '</button>';
						?>
					</div>
				<?php }

				if ($title) echo '<h2 class="team__title">' . $title . '</h2>';
				?>
			</div>

			<div class="team__slider">
				<div class="team__swiper">

					<?php
					foreach ($slider as $slide) {
						$img = wp_get_attachment_image_url($slide['img'], 'medium');
						$name = esc_html($slide['name']);
						$descr = esc_html($slide['descr']);
					?>
						<div class="team__slide">
							<div class="team__img-ibg">
								<img class="swiper-lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="<?php echo $name ?>">
							</div>

							<div class="team__content">
								<div class="team__name"><?php echo $name ?></div>
								<?php if ($descr) echo '<div class="team__descr">' . $descr . '</div>'; ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>