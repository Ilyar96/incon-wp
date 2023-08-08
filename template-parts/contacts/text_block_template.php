<?php $list = get_field('contacts_tb_col'); ?>

<div class="contacts__row contacts__row--info">
	<?php
	foreach ($list as  $item) {
		$title = wp_kses_post($item['title']);
		$text = wp_kses_post($item['text']);
	?>
		<div class="contacts__col">
			<?php
			if ($title) echo '<h2 class="contacts__subtitle">' . $title . '</h2>';
			if ($text) echo '<div class="contacts__info">' . $text . '</div>';
			?>
		</div>
	<?php } ?>
</div>