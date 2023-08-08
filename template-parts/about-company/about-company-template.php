<?php
$stats = get_field('about_stats_block');
$title = esc_html(get_field('about_stats_title'));
$list = get_field('about_stats_list');

if ($stats || $title || $list) {
?>

	<section class="case-block case-block--about">
		<div class="case-block__container">
			<div class="case-block__content editor-block">
				<div class="case-block__grid">
					<div class="case-block__col">
						<?php
						if ($stats) {
						?>
							<div class="stats">
								<?php
								foreach ($stats as $item) {
									$number = esc_html($item['number']);
									$text = esc_html($item['text']);
									$bgr = $item['bgr'];
									$color = $bgr['color'];
									$image = wp_get_attachment_image_url($bgr['image'], 'medium');
									$bgr_style = '';
									$font_color = $item['font_color'];
									$font_color_style = '';

									if ($font_color) {
										$font_color_style = 'color:' . $font_color . ';';
									}

									if ($color) {
										$bgr_style = 'background-color:' . $color . ';';
									} elseif ($image) {
										$bgr_style = 'background-image: url(' . $image . ');';
									}
								?>
									<div class="stats__item" style="<?php echo $font_color_style . $bgr_style; ?>">
										<div class="stats__number"><?php echo $number ?></div>
										<div class="stats__text"><?php echo $text ?></div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="case-block__col">
						<?php
						if ($title) echo '<h2 class="case-block__title case-block__title--stats">' . $title . '</h2>';
						if ($list) { ?>
							<ul>
								<?php
								foreach ($list as $item) {
									echo '<li>' . $item['text'] . '</li>';
								} ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>