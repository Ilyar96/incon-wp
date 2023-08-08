<?php
add_action('init', 'incon_register_custom_post_type');

function incon_register_custom_post_type()
{
	if (!taxonomy_exists('case-category')) {
		register_taxonomy('case-category', ['case'], [
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => [
				'name'              =>  __('Категории', 'incon'),
				'singular_name'     =>  __('Категория', 'incon'),
				'search_items'      =>  __('Поиск Категории', 'incon'),
				'all_items'         =>  __('Все Категории', 'incon'),
				'view_item '        =>  __('Смотреть Категорию', 'incon'),
				'parent_item'       =>  __('Родительская Категория', 'incon'),
				'parent_item_colon' =>  __('Родительская Категория:', 'incon'),
				'edit_item'         =>  __('Редактировать Категорию', 'incon'),
				'update_item'       =>  __('Обновить Категорию', 'incon'),
				'add_new_item'      =>  __('Добавить новую Категорию', 'incon'),
				'new_item_name'     =>  __('Добавить название новой Категории', 'incon'),
				'menu_name'         =>  __('Категории', 'incon'),
				'back_to_items'     =>  __('← Вернуться к Категориям', 'incon'),

			],
			'description'           => '',
			'public'                => true,
			'hierarchical'          => true,

			'capabilities'          => array(),
			'meta_box_cb'           => null,
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'rest_base'             => null,
			'has_archive' => true,
		]);
	}

	register_post_type('case', array(
		'label'  => null,
		'labels' => array(
			'name'               =>  __('Опыт', 'incon'),
			'singular_name'      =>  __('Кейс', 'incon'),
			'add_new'            =>  __('Добавить Кейс', 'incon'),
			'add_new_item'       =>  __('Добавление Кейса', 'incon'),
			'edit_item'          =>  __('Редактирование Кейса', 'incon'),
			'new_item'           =>  __('Новый Кейс', 'incon'),
			'view_item'          =>  __('Смотреть Кейс', 'incon'),
			'search_items'       =>  __('Искать Кейс', 'incon'),
			'not_found'          =>  __('Не найдено', 'incon'),
			'not_found_in_trash' =>  __('Не найдено в корзине', 'incon'),
			'menu_name'          =>  __('Кейсы', 'incon'),
		),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'show_in_rest' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'hierarchical'       => false,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'rewrite' => array('slug' => 'experience'),
	));
}
