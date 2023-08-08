<?php

/**
 * incon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package incon
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	// define('_S_VERSION', '1.0.0');
	define('_S_VERSION', time());
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function incon_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on incon, use a find and replace
		* to change 'incon' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('incon', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'incon'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'incon_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'incon_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function incon_content_width()
{
	$GLOBALS['content_width'] = apply_filters('incon_content_width', 640);
}
add_action('after_setup_theme', 'incon_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function incon_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'incon'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'incon'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'incon_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function incon_scripts()
{
	if (is_page_template('page-template-home.php') || is_page_template('page-template-price.php')) {
		wp_enqueue_script('inputmask-lib', get_template_directory_uri() . '/js/inputmask.min.js', array(), _S_VERSION, true);
		wp_enqueue_script('incon-ajax', get_template_directory_uri() . '/js/ajax.js', array(), _S_VERSION, true);
		wp_localize_script(
			'incon-ajax',
			'incon',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('wp-pageviews-nonce'),
			)
		);
	}


	wp_enqueue_style('incon-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.min.css', array(), _S_VERSION);


	if (is_page_template('page-template-home.php')) {
		wp_enqueue_script('chart-lib', get_template_directory_uri() . '/js/chart.min.js', array(), _S_VERSION, true);
	}

	wp_enqueue_script('main', get_template_directory_uri() . '/js/app.min.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'incon_scripts');


//acf option
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Информация сайта',
		'menu_title'	=> 'Параметры',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'update_button' => __('Обновить', 'acf'),
		'redirect'		=> false
	));
}

/**
 * Регистрация post_type
 */
require get_template_directory() . '/inc/custom_post_types.php';

/**
 * Хлебные крошки
 */
require get_template_directory() . '/inc/breadcrumbs.php';

## отключаем создание миниатюр файлов для указанных размеров
add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');
function delete_intermediate_image_sizes($sizes)
{
	// размеры которые нужно удалить
	return array_diff($sizes, [
		'medium_large',
		'1536x1536',
		'2048x2048',
	]);
}

/**
 * Блоки Gutenberg с ACF
 */
add_action('acf/init', 'newfancy_acf_blocks_init');
function newfancy_acf_blocks_init()
{

	// Check function exists.
	if (function_exists('acf_register_block_type')) {

		// Register a case-intro block.
		acf_register_block_type(array(
			'name'              => 'case-intro-block',
			'title'             => __('INCON Интро блок', 'incon'),
			'description'       => __('Интро блок для страницы с кейсом.', 'incon'),
			'render_template'   => 'template-parts/blocks/case/case-intro.php',
			'category'          => 'formatting',
		));

		// Register a case-more-block.
		acf_register_block_type(array(
			'name'              => 'case-more-block',
			'title'             => __('INCON Текстовой блок со скрываемым контентом (Споллером)', 'incon'),
			'description'       => __('Текстовой блок со скрываемым контентом (Споллером) для страницы с кейсом.', 'incon'),
			'render_template'   => 'template-parts/blocks/case/case-more-block.php',
			'category'          => 'formatting',
		));

		// Register a case-list-block.
		acf_register_block_type(array(
			'name'              => 'case-list-block',
			'title'             => __('INCON Блок со списком', 'incon'),
			'description'       => __('Блок со списком для страницы с кейсом.', 'incon'),
			'render_template'   => 'template-parts/blocks/case/case-list.php',
			'category'          => 'formatting',
		));

		// Register a case-gallery block.
		acf_register_block_type(array(
			'name'              => 'case-gallery-block',
			'title'             => __('INCON Блок с галереей', 'incon'),
			'description'       => __('Блок с галереей для страницы с кейсом.', 'incon'),
			'render_template'   => 'template-parts/blocks/case/case-gallery-block.php',
			'category'          => 'formatting',
		));

		// Register a case-review-block.
		acf_register_block_type(array(
			'name'              => 'case-review-block',
			'title'             => __('INCON Блок отзыва', 'incon'),
			'description'       => __('Блок отзыва для страницы с кейсом.', 'incon'),
			'render_template'   => 'template-parts/blocks/case/case-review-block.php',
			'category'          => 'formatting',
		));
	}
}

remove_filter('acf_the_content', 'wpautop');

function declOfNum($num, $titles)
{
	$cases = array(2, 0, 1, 1, 1, 2);

	return " " . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}

//Form Ajax
add_action('wp_ajax_contacts_form', 'incon_send_form');
add_action('wp_ajax_nopriv_contacts_form', 'incon_send_form');

function incon_send_form()
{
	if (isset($_POST['contacts']) && isset($_POST['contactTypes'])) {
		$contacts = $_POST['contacts'];
		$contact_type = $_POST['contactTypes'];

		$admin_email = get_option('admin_email');

		$headers = array(
			'From: Консалтинговая компания In-con <spb@in-con.ru>',
			'content-type: text/html; charset=utf-8',
			'Cc: <' . $admin_email . '>',
		);

		$message = '
                <p><strong>Контактные данные (' . $contact_type . ') :</strong></p>
                <p>' . $contacts . '</p>
             ';

		wp_mail($admin_email, 'Способ связи', $message, $headers);
	}

	wp_die();
}

function setPostViews($postID)
{
	$count_key = 'views';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
function getPostViews($postID)
{
	$count_key = 'views';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID,	$count_key,	'0');
		return	"0";
	}
	return	$count;
}

// добавляем запланированный хук
add_action('wp', 'my_activation');
function my_activation()
{
	if (!wp_next_scheduled('my_daily_event')) {
		wp_schedule_event(time(), 'daily', 'my_daily_event');
	}
}

// добавляем функцию к указанному хуку
function do_this_daily()
{
	global $wpdb;
	$postids = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_status='publish' AND post_type='post' ORDER BY ID ASC");

	foreach ($postids as $postid) {
		$postid = $postid->ID; // ID записи

		// считаем количество просмотров
		$views = (int)get_post_meta($postid, 'views', true);
		// считаем дни существования поста
		//$dtNow = get_the_time('U'); $dtTime = current_time('U'); $diff = $dtTime - $dtNow;
		$dtNow = get_post_time('U', true, $postid);
		$dtTime = current_time('U');
		$diff = $dtTime - $dtNow;

		// считаем комментарии и сумму просмотров с комментариями
		$comments = get_comments_number($postid);
		$summa = $views + $comments;
		// считаем индекс популярности
		if ($days = '0') {
			$pop_index = $summa / 1;
		} else {
			$days = (int)$diff / 86400;
			$pop_index = $summa / $days;
		}
		$pop = round($pop_index, 2);
		// записываем индекс популярности в произвольное поле поста
		update_post_meta($postid, 'popularity', $pop);
	}
}
add_action('my_daily_event', 'do_this_daily', 10, 2);
