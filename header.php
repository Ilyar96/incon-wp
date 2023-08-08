<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,500&display=swap&_v=20220816165817" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	wp_body_open();
	$image = get_field('header_logo', 'option');
	$home_link_start = '';
	$home_link_end = '';
	$secondary_class = '';
	$wrapper_class = 'wrapper--home';

	if (!is_page_template('page-template-home.php')) {
		$home_link_start = '<a href="' . get_home_url('/') . '">';
		$home_link_end = '</a>';
		$secondary_class = 'header--secondary';
		$wrapper_class = '';
	}

	?>
	<div class="wrapper <?php echo $wrapper_class ?>">
		<header class="header <?php echo $secondary_class ?>" data-lp>
			<div class="header__container">
				<div class="header__logo">
					<?php
					if ($image) {
						echo $home_link_start . '<img class="lazy" src="' . get_template_directory_uri() . '/img/icons/empty.png" data-src="' . esc_url($image) . '" alt="Логотип">' . $home_link_end;
					} ?>
				</div>

				<?php
				$phone = get_field('phone_number', 'option');
				if ($phone) { ?>
					<a href="tel:+<?php echo preg_replace('![^0-9]+!', '', $phone) ?>" class="header__phone">
						<?php esc_html_e($phone) ?>
					</a>
				<?php } ?>


				<div class="header__menu menu">
					<button type="button" class="menu__icon icon-menu"><span></span></button>
					<nav class="menu__body">
						<?php
						echo wp_nav_menu([
							'theme_location'  => 'menu-1',
							'container'       => 'ul',
							'menu_class'      => 'menu__list',
						]);
						?>
					</nav>
				</div>
			</div>
		</header>