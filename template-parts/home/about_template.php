<!-- About -->
<?php
$suptitle = wp_kses_post(get_field('approach_suptitle'));
$title = wp_kses_post(get_field('approach_title'));
$tabs = get_field('approach_tabs');

if ($suptitle ||	$title || $tabs) { ?>
	<section class="about">
		<div class="about__decor about__decor--left"></div>
		<div class="about__decor about__decor--right"></div>

		<div class="about__container">
			<?php
			if ($suptitle || $title) {
				echo '<h2 class="about__title title"><span>' . 	$suptitle . '</span>' . $title . '</h2>';
			}

			if ($tabs) { ?>
				<div data-tabs="991" data-tabs-animate="1000" class="about__tabs">
					<nav data-tabs-titles class="about__navigation">
						<?php
						if ($tabs) {
							foreach ($tabs as $key => $tab) {
								$active_class = '';
								if ($key === 0) {
									$active_class = '_tab-active';
								}
								echo '<button type="submit" class="about__nav-title ' . $active_class . '">' . wp_kses_post($tab['title']) . '</button>';
							}
						}
						?>
					</nav>
					<span class="about__line" data-tab-line></span>
					<div data-tabs-body class="about__content">
						<!-- Tab-body -->
						<?php
						if ($tabs) {
							foreach ($tabs as $index => $tab) {
								$tabs_body = $tab['body'];
								$tabs_img_id = $tabs_body['img'];
								$tabs_img =	esc_url(wp_get_attachment_image_url($tabs_img_id, 'large'));
								$tabs_img_full =	esc_url(wp_get_attachment_image_url($tabs_img_id, 'full'));
								$tabs_list = $tabs_body['list'];
								$hidden_class = '';
								if ($index !== 0) {
									$hidden_class = '_hidden';
								}
						?>
								<div class="about__tabs-body <?php echo $hidden_class; ?>">
									<div class="about__tabs-row row">
										<ul class="about__col-left col">
											<?php
											foreach ($tabs_list as $item) {
												echo '<li>' . wp_kses_post($item['text']) . '</li>';
											}
											?>
										</ul>
										<div class="about__col-right col" data-gallery>
											<div class="about__img-block" data-src="<?php echo $tabs_img_full ?>">
												<picture>
													<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $tabs_img ?>" alt="">
												</picture>
											</div>
										</div>
									</div>
								</div>
						<?php }
						} ?>
						<!-- Tab-body -->
					</div>
				</div>
			<?php } ?>
		</div>
	</section><!-- /About -->

<?php } ?>