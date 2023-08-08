<?php
if (!is_active_sidebar('sidebar-1')) {
	return;
}

$rubric_title = esc_html(get_field('sidebar_rubrics_title', 'option'));
$popular_title = esc_html(get_field('sidebar_popular_title', 'option'));
$btn = esc_html(get_field('sidebar_nav_btn', 'option'));
?>

<aside class="news__sidebar sidebar">
	<button class="sidebar__nav-btn" data-spoller><?php echo $btn ?></button>

	<div class="sidebar__body">
		<div class="sidebar__block sidebar__block--white">
			<?php if ($rubric_title) echo '<h3 class="sidebar__title">' . $rubric_title . '</h3>' ?>

			<ul class="sidebar__rubrics">
				<?php
				$categories = get_categories(array(
					'taxonomy'     => 'category',
					'type'         => 'post',
					'orderby'      => 'name',
					'order'        => 'ASC',
				));

				foreach ($categories as $categoty) {
					echo '<li class="sidebar__rubric"><a href="' . get_category_link($categoty->term_id) . '">' . $categoty->name . '</a></li>';
				}
				?>
			</ul>
		</div>

		<div class="sidebar__block sidebar__block--white">
			<?php if ($popular_title) echo '<h3 class="sidebar__title">' . $popular_title . '</h3>' ?>

			<ul class="sidebar__popular">
				<?php
				$args = array(
					'meta_query'     => array(
						'meta_value_num' => array(
							'key'	=> 'popularity'
						),
					),
					'orderby'            => 'meta_value_num',
					'posts_per_page'     => 5,
					'post_status'        => 'publish',
					'order'              => 'DESC'
				);
				$query = new WP_Query($args);
				while ($query->have_posts()) : $query->the_post(); ?>
					<li class="sidebar__popular-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<div class="sidebar__block">
			<ul class="sidebar__tags">
				<?php
				$tags = get_tags();

				foreach ($tags as  $tag) {
					echo '<li class="sidebar__tag tag-block"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
</aside>