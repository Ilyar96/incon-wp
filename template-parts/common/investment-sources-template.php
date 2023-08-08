<?php
$group = get_field('the_best_investment', 'option');
if ($group) {
	$title = wp_kses_post($group['title']);
	$btn_text = esc_html($group['text']);
	$file = esc_url($group['file']['url']);
	$text2 = esc_html($group['text2']);
?>
	<section class="sources">
		<div class="sources__container">
			<div class="sources__body">
				<h2 class="sources__title"><?php echo $title ?></h2>
				<div class="sources__download">
					<a href="<?php echo $file ?>" class="sources__btn btn btn--secondary" download><?php echo $btn_text ?></a>
					<div class="sources__info"><?php echo $text2 ?></div>
				</div>
			</div>
		</div>
	</section>
<?php
}
