<?php
$is_display = get_field('about_video_is_display');
$img = wp_get_attachment_image_url(get_field('about_video_img'), 'large');
$play_icon = wp_get_attachment_image_url(get_field('about_video_play_icon'), 'thumbnail');
$text = esc_html(get_field('about_video_text'));
$ytb_code = esc_html(get_field('about_video_video_link'));

if ($is_display) {
?>

	<div class="about-video">
		<div class="about-video__container">
			<div class="about-video__body">
				<div class="about-video__ibg-ibg">
					<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="">
				</div>
				<div class="about-video__content">
					<div class="about-video__play" data-gallery>
						<a href="https://www.youtube.com/embed/<?php echo $ytb_code ?>" data-lg-size="1280-720" data-poster="<?php echo $img ?>">
							<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $play_icon ?>" alt="<?php echo $text ?>">
						</a>
					</div>
					<?php if ($text) echo '<div class="about-video__text">' . $text . '</div>'; ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>