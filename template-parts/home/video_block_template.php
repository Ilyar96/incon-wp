<?php
$is_display = get_field('is_display_video_block');
$img = esc_url(get_field('video_img'));
$title = esc_html(get_field('video_block_title'));
$text = esc_html(get_field('video_block_text'));
$link = esc_html(get_field('video_block_link'));

if ($is_display) {
?>
	<section class="video-block">
		<div class="video-block__img-ibg">
			<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="<?php echo $title ?>">
		</div>

		<div class="video-block__container">
			<div class="video-block__content">
				<?php if ($text) echo '<h4 class="video-block__suptitle">' . $text . '</h4>'; ?>
				<?php if ($title) echo '<h2 class="video-block__title title">' . $title . '</h2>'; ?>
			</div>
			<?php if ($link) { ?>
				<div class="video-block__link" data-gallery>
					<div class="video-block__play" data-lg-size="1280-720" data-src="https://www.youtube.com/embed/<?php echo $link ?>" data-poster="<?php echo $img ?>">
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>