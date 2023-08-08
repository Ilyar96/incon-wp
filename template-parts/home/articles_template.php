<?php
$categories = get_categories();
$number_posts = 6;
$is_home_news = get_field('is_home_news');
$categories_count = get_field('categories_count');
$title = esc_html(get_field('news_title'));
$btn = esc_html(get_field('news_btn'));
?>

<?php if ($is_home_news) { ?>
	<section class="articles">
		<div class="articles__container">
			<?php if ($title) echo '<h2 class="articles__title title">' . $title . '</h2>' ?>

			<div data-tabs class="articles__tabs">
				<nav data-tabs-titles class="articles__navigation">
					<?php
					foreach ($categories as $index => $category) {
						$active_class = '';
						if ($index === 0) {
							$active_class = ' _tab-active';
						}

						echo '<button type="submit" class="articles__nav-title' . $active_class . '">' . $category->name . '</button>';
					} ?>
				</nav>
				<span class="articles__line" data-tab-line></span>
				<div data-tabs-body class="articles__content">
					<?php
					foreach ($categories as $cat_index => $category) {
						$posts_count = 0;
						$posts = get_posts([
							'numberposts' => $categories_count,
							'category_name' => $category->slug,
							'post_type' => 'post',
							'orderby' => 'menu_order'
						]);
						$cat_hidden = '';
						if ($cat_index !== 0) {
							$cat_hidden = ' hidden ';
						}
					?>
						<div class="articles__tabs-body" <?php echo $cat_hidden ?>>
							<div class="articles__grid">
								<?php

								foreach ($posts as $index => $post) {
									$posts_count++;
									setup_postdata($post);
									$img = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium'));
									$title = esc_html(get_the_title());
									$date = get_the_date();
									$tags = get_the_tags(get_the_ID());
									$is_display = get_field('is_display_article_in_home', get_the_ID());
									$hidden = '';
									if ($index + 1 > $number_posts) {
										$hidden = ' hidden ';
									}

									if ($is_display) {
								?>
										<a href="#" class="articles__item" <?php echo $hidden ?>>
											<div class="articles__img-ibg">
												<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo $img ?>" alt="<?php echo $title ?>">
											</div>
											<h3 class="articles__preview-title"><?php echo $title ?></h3>
											<div class="articles__bottom">
												<div class="articles__date"><?php echo $date ?></div>
												<div class="articles__tag">
													<?php
													if ($tags) {
														foreach ($tags as $index => $tag) {
															$before = '';
															if ($index !== 0) {
																$before = ', ';
															}

															echo $before . esc_html($tag->name);
														}
													}
													?>
												</div>
											</div>
										</a>
								<?php
									}
								}
								wp_reset_postdata();
								?>
							</div>
							<?php if ($posts_count > $number_posts && $btn) { ?>
								<button class="articles__btn btn btn--more" type="button"><?php echo $btn; ?></button>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>