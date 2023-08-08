<?php
$title = esc_html(get_field('history_title'));
$spollers = get_field('history_spollers');

if ($spollers) {
?>

	<section class="history">
		<div class="history__container" data-spollers data-one-spoller>
			<?php
			if ($title) echo '<h2 class="history__title title">' . $title . '</h2>';

			foreach ($spollers as $spoller) {
				$spoller_title = esc_html($spoller['title']);
				$descr = wp_kses_post($spoller['descr']);
				$link_text = esc_html($spoller['link_text']);
				$case_link = get_post_permalink($spoller['case_link'][0]->ID);
				if (!$link_text) {
					$link_text = 'Посмотреть проект';
				}
			?>
				<button class="history__subtitle" data-spoller type="button"><?php echo $spoller_title; ?></button>
				<div class="history__body">
					<div class="history__text"><?php echo $descr; ?></div>
					<?php if ($case_link) echo '<a href="' . $case_link . '" class="history__link">' . $link_text . '</a>' ?>
				</div>
			<?php } ?>

		</div>
	</section>
<?php } ?>