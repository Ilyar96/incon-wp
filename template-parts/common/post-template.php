<?php global $wp_query ?>

<section class="news">
	<div class="news__container" data-spollers="991,max">
		<div class="news__body">

			<?php if ($wp_query->have_posts()) : 	while ($wp_query->have_posts()) : the_post(); ?>

			<article class="news__article-preview article-preview">
				<a href="<?php echo esc_url(get_the_permalink()) ?>" class="article-preview__top">
					<div class="article-preview__img-ibg">
						<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>" alt="<?php esc_html(get_the_title()) ?>">
					</div>
					<h3 class="article-preview__title"><?php echo esc_html(get_the_title()) ?></h3>
				</a>
				<div class="article-preview__bottom">
					<div class="article-preview__descr"><?php echo  esc_html(get_the_excerpt()) ?></div>
					<div class="article-preview__date"><?php echo  get_the_date() ?></div>
				</div>
			</article>

				<?php endwhile;

				wp_reset_postdata();

				if ($wp_query->max_num_pages > 1) { ?>
					<nav class="news__pagination pagination">
						<div class="nav-links">
							<?php
								echo paginate_links(array(
									'prev_next' => false
								));  ?>
						</div>
					</nav>
				<?php } ?>
			<?php else : ?>
				<h2><?php esc_html_e('No news', 'wayup'); ?></h2>
			<?php endif; ?>
		</div>
		<?php echo get_sidebar(); ?>
	</div>
</section>