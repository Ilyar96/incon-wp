<?php // Breadcrumbs Custom Function

function incon_get_breadcrumbs($case_link = null, $case_name = null)
{

	$text['home']     = __('Главная', 'incon');
	$text['search']   = __('Результаты поиска', 'incon') . ' "%s"';
	$text['author']   = __('Автор', 'incon') . ' %s';
	$text['404']      = __('Ошибка 404', 'incon');

	$show_current   = 1;
	$show_on_home   = 0;
	$show_home_link = 1;
	$show_title     = 1;
	$delimiter      = '<span class="breadcrumbs__sep"></span>';
	$before         = '<span class="breadcrumbs__current-link">';
	$after          = '</span>';
	$breadcrumb_wrapper_class = 'breadcrumbs__container';

	global $post;
	$home_link    = home_url('/');
	$link_attr    = ' class="breadcrumbs__link"';
	$link         = '<a' . $link_attr . ' href="%1$s">%2$s</a>';
	if ($post) {
		$parent_id    = $parent_id_2 = $post->post_parent;
	} else {
		$parent_id    = $parent_id_2 = '';
	}
	$frontpage_id = get_option('page_on_front');

	global  $blog_post;
	global $wp_query;

	if (get_post_type($blog_post) == 'post' && !is_archive() && !is_singular() && !is_404()) {
		echo '<div class="' . $breadcrumb_wrapper_class . '">';
		printf($link, $home_link, $text['home']);
		echo $delimiter . $before . single_post_title('', false) . $after . '</div>';
	}

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="' . $breadcrumb_wrapper_class . '"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
	} else {

		echo '<div class="' . $breadcrumb_wrapper_class . '" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo sprintf($link, $home_link, $text['home']);
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		$queried_object = $wp_query->queried_object;
		if (is_category()) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>', $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before .  single_cat_title('', false) . $after;
		} elseif (is_search()) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif (is_day()) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
		} elseif (is_month()) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
		} elseif (is_year()) {
			echo $before . get_the_time('Y') . $after;
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->name);
				if ($post_type->name === 'case') {
					if ($case_link || $case_name) {
						echo $delimiter;
						printf($link, $case_link, $case_name);
					}
				}
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>', $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				$blog_title = get_the_title(get_option('page_for_posts'));
				$blog_permalink = get_permalink(get_option('page_for_posts'));
				printf($link,  $blog_permalink, $blog_title);
				echo $delimiter;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if ($post) {
				if (is_tax()) {
					$queried_object = get_queried_object();
					printf($link, get_post_type_archive_link($post_type->name), $post_type->labels->name);
					echo $delimiter . $before . $queried_object->name . $after;
				} else {
					echo $before . $post_type->labels->name . $after;
				}
			} else {
				echo $before . wp_title('') . $after;
			}
		} elseif (is_attachment()) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID);
			$cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>', $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif (is_page() && !$parent_id) {
			if ($show_current == 1) echo $before . get_the_title() . $after;
		} elseif (is_page() && $parent_id) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs) - 1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}
		} elseif (is_tag()) {
			echo $before .  single_tag_title('', false) . $after;
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif (is_404()) {
			echo $before . $text['404'] . $after;
		}

		echo '</div>';
	}
}
