<footer class="footer">
	<div class="footer__container">
		<div class="footer__logo">
			<?php
			$image = get_field('footer_log', 'option');
			$home_link_start = '';
			$home_link_end = '';

			if (!is_page_template('page-template-home.php')) {
				$home_link_start = '<a href="' . get_home_url('/') . '">';
				$home_link_end = '</a>';
			}
			if ($image) {
				echo $home_link_start . '<img class="lazy" src="' . get_template_directory_uri() . '/img/icons/empty.png" data-src="' . esc_url($image) . '" alt="Логотип">' . $home_link_end;
			} ?>
		</div>

		<?php $phone = get_field('phone_number', 'option');
		$mail = get_field('inconn_mail', 'option');
		if ($phone || $mail) { ?>
			<div class="footer__contacts">
				<?php
				if ($phone) { ?>
					<a href="tel:+<?php esc_html_e(preg_replace('![^0-9]+!', '', $phone)) ?>" class="footer__phone">
						<?php esc_html_e($phone) ?>
					</a>
				<?php }

				if ($mail) { ?>
					<a href="mailto:<?php esc_html_e($mail) ?>" class="footer__mail">
						<?php esc_html_e($mail) ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>

		<?php
		$privacy_page = get_field('privacy_page', 'option');
		$privacy_link = esc_url($privacy_page['privacy_link']);
		$privacy_text = esc_html($privacy_page['privacy_text']);
		$creator = get_field('site_creater', 'option');
		$creator_link = esc_url($creator['creator_tlink']);
		$creator_text = esc_html($creator['creator_text1']);

		if ($creator || $privacy_page) {
			echo '<div class="footer__links">';
			if ($privacy_page) {
				echo '
					<a href="' . $privacy_link . '" class="footer__link" target="_blank">' . $privacy_text . '</a>
				';
			}
			if ($creator) {
				echo '
					<div class="footer__link">' . $creator_text . ' <a href="' . $creator_link . '" target="_blank">' . esc_html__($creator_link) . '</a></div>
				';
			}
			echo '</div>';
		} ?>
	</div>
</footer>
</div><!-- #page -->

<?php if (is_page_template('page-template-home.php') || is_page_template('page-template-price.php')) {
	$popup_success = get_field('popup_success', 'option');
	$success_icon = wp_get_attachment_image_url($popup_success['icon'], 'thumbnail');
	$success_text = esc_html($popup_success['text']);
	$popup_error = get_field('popup_error', 'option');
	$error_icon = wp_get_attachment_image_url($popup_error['icon'], 'thumbnail');
	$error_text = esc_html($popup_error['text']);
?>
	<div id="mail-success" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__content">
				<button data-close type="button" class="popup__close">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 18 18">
						<defs>
							<path id="avzva" d="M691.485 160.07l-1.414 1.415-7.071-7.071-7.071 7.071-1.414-1.414 7.07-7.071-7.07-7.071 1.414-1.415 7.07 7.071 7.072-7.07 1.414 1.414-7.07 7.07z" />
						</defs>
						<g>
							<g transform="translate(-674 -144)">
								<use fill="currentColor" xlink:href="#avzva" />
							</g>
						</g>
					</svg>
				</button>
				<div class="popup__mail mail">
					<div class="mail__icon">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $success_icon ?>" alt="" />
					</div>
					<div class="mail__text"><?php echo $success_text ?></div>
				</div>
			</div>
		</div>
	</div>

	<div id="mail-error" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__content">
				<button data-close type="button" class="popup__close">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 18 18">
						<defs>
							<path id="avzva" d="M691.485 160.07l-1.414 1.415-7.071-7.071-7.071 7.071-1.414-1.414 7.07-7.071-7.07-7.071 1.414-1.415 7.07 7.071 7.072-7.07 1.414 1.414-7.07 7.07z" />
						</defs>
						<g>
							<g transform="translate(-674 -144)">
								<use fill="currentColor" xlink:href="#avzva" />
							</g>
						</g>
					</svg>
				</button>
				<div class="popup__mail mail">
					<div class="mail__icon">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $error_icon ?>" alt="" />
					</div>
					<div class="mail__text"><?php echo $error_text ?></div>
				</div>
			</div>
		</div>
	</div>

	<div id="mail-success-btn" aria-hidden="true" data-popup="#mail-success" hidden></div>
	<div id="mail-error-btn" aria-hidden="true" data-popup="#mail-error" hidden></div>
<?php
}

wp_footer();

if (is_page_template('page-template-home.php')) {
	get_template_part('template-parts/home/chart_script');
} ?>
</body>

</html>