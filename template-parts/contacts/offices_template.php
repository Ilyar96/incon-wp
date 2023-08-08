<?php
$title = esc_html(get_field('offices_title'));
$list = get_field('offices');

if ($title) echo '<h2 class="contacts__subtitle">' . $title . '</h2>';
?>

<div class="contacts__row">
	<?php
	foreach ($list as  $item) {
		$city = esc_html($item['city']);
		$number = esc_html($item['number']);
		$mail = esc_html($item['mail']);
		$address = esc_html($item['address']);
	?>
		<div class="contacts__col">
			<div class="contacts__card">
				<?php
				if ($city) echo '<div class="contacts__city">' . $city . '</div>';
				if ($number) echo '<a href="tel:+' . preg_replace('![^0-9]+!', '', $number) . '" class="contacts__card-number">' . $number . '</a>';
				if ($mail) echo '<a href="mailto:' . $mail . '" class="contacts__card-number">' . $mail . '</a>';
				if ($address) echo '<div class="contacts__address">' . $address . '</div>';
				?>
			</div>
		</div>
	<?php }	?>
</div>