<?php
$images = get_field('callback_img', 'option');
$img_desk = wp_get_attachment_image_url($images['desk'], 'medium');
$img_mob = wp_get_attachment_image_url($images['mob'], 'large');
$title = esc_html(get_field('callback_title', 'option'));
$nav = get_field('callback_nav', 'option');
$whatsapp = $nav['whatsapp'];
$telegram = $nav['telegram'];
$email = $nav['email'];
$privacy_page = get_field('privacy_page', 'option');
$privacy_link = esc_url($privacy_page['privacy_link']);
?>

<div class="callback__row row">
	<div class="callback__img-ibg col">
		<picture>
			<source media="(max-width: 991.98px)" srcset="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-srcset="<?php echo $img_mob; ?>">
			<img class=" lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img_desk ?>" alt="<?php echo $title ?>">
		</picture>
	</div>


	<div class="callback__form-block col">
		<div class="form-block">
			<?php if ($title) echo '<h2 class="form-block__title">' . $title . '</h2>'; ?>
			<nav class="form-block__nav">
				<?php
				if ($whatsapp) {
					echo '<button class="form-block__nav-link _active" type="button" data-type="whatsapp" data-placeholder="' . $whatsapp['validate'] . '">' . $whatsapp['text'] . '</button>';
				}
				if ($telegram) {
					echo '<button class="form-block__nav-link" type="button" data-type="telegram" data-placeholder="' . $telegram['validate'] . '">' . $telegram['text'] . '</button>';
				}
				if ($email) {
					echo '<button class="form-block__nav-link" type="button" data-type="email" data-placeholder="' . $email['validate'] . '">' . $email['text'] . '</button>';
				}
				?>
			</nav>
			<?php
			// echo do_shortcode('[contact-form-7 id="350" title="Способ связи"]');
			?>
			<form class="form-block__form form">
				<div class="form__input-wrapper">
					<input type="text" name="contacts" data-type="whatsapp" class="form__input" placeholder="Введите номер телефона" data-required data-validate data-error="Поле обязательно к заполнению">
					<input type="hidden" name="contactTypes" value="Whatsapp">
				</div>

				<div class="form__footer">

					<div class="form__btn-wrapper">
						<button type="submit" class="form__btn btn btn--secondary">Получить
							предложение</button>
					</div>

					<div class="form__policy">
						<span>Отправляя форму выше, вы соглашаетесь
							с <a href="<?php echo $privacy_link ?>">политикой
								конфиденциальности</a></span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>