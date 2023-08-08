<?php
get_header();

global $wp_query;
?>

<main class="page page--gray">

	<?php $queried_object = get_queried_object();
	$this_tax = get_taxonomy($queried_object->taxonomy);
	$cases_count = $queried_object->count;
	$btn_count = $cases_count % 4;
	$subtitle = esc_html(get_field('case_cat_subtitle1', 'option'));
	$project1 = get_field('case_cat_subtitle2_1', 'option');
	$project2 = get_field('case_cat_subtitle2_2', 'option');
	$project3 = get_field('case_cat_subtitle2_3', 'option');
	?>

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<section class="cases-list">
		<div class="cases-list__container">
			<div class="cases-list__header">
				<h1 class="cases-list__title title"><?php echo $queried_object->name; ?></h1>
				<h2 class="cases-list__title title">Выполнено <?php echo $cases_count ?> <?php echo declOfNum($cases_count, array($project1, $project2, $project3)); ?>:</h2>
			</div>

			<div class="cases-list__grid">
				<?php
				$post_index = 0;

				$posts = get_posts([
					'numberposts' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'case-category',
							'field'    => 'slug',
							'terms'    => $wp_query->query_vars['case-category']
						)
					),
					'orderby' => 'date ',
					'order' => 'DESC',
					'post_type' => 'case',
					'suppers_filter' => true
				]);

				foreach ($posts as $post) {
					setup_postdata($post);

					$investments_text = esc_html__(get_field('case_investments_text'));
					$investments_sum = esc_html__(get_field('case_investments_sum'));
					$img_mob = wp_get_attachment_image_url(get_field('case_page_img_mob'), 'large');
					$post_hidden_class = '';
					if ($post_index > 3) {
						$post_hidden_class = 'hidden';
					} ?>
					<article class="cases-list__item" <?php echo $post_hidden_class ?>>
						<a href="<?php echo esc_url(get_the_permalink()) ?>" class="cases-list__img-ibg">
							<picture>
								<?php if ($img_mob) { ?>
									<source media="(max-width: 991.98px)" srcset="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-srcset="<?php echo $img_mob ?>">
								<?php } ?>
								<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>" alt="">
							</picture>
						</a>

						<div class="cases-list__content">
							<h3 class="cases-list__subtitle"><?php echo esc_html__(get_the_title()) ?></h3>
							<div class="cases-list__descr"><?php echo esc_html__(get_the_excerpt()) ?></div>
							<div class="cases-list__footer">
								<?php if ($investments_sum) { ?>
									<div class="cases-list__investment"><b><?php echo $investments_text ?> </b> <?php echo $investments_sum ?></div>
								<?php } ?>
								<a href="<?php echo esc_url(get_the_permalink()) ?>" class="cases-list__link btn btn--outline">Подробнее</a>
							</div>
						</div>
					</article>
				<?php
					$post_index++;
				}
				wp_reset_postdata();
				?>
			</div>
			<?php
			if ($cases_count > 4) {
				echo '<button class="cases-list__more btn btn--more" type="button"><span>Показать еще <span class="cases-list__count">' . $btn_count . '</span> ' . declOfNum($btn_count, array($project1, $project2, $project3)) . '</span></button>';
			}
			if ($cases_count  === 0) { ?>
				<h2><?php esc_html_e('Нет кейсов', 'incon'); ?></h2>
			<?php } ?>
		</div>
	</section>

	<?php
	$term = get_queried_object();

	$title1 = esc_html(get_field('case_cat_title1', $term));
	$title2 = esc_html(get_field('case_cat_title_2', $term));
	$map = get_field('case_cat_map', $term);

	if ($map) { ?>
		<section class="map">
			<?php
			if ($title1 || $title2) echo '<h2 class="map__title">' .	$title1 . '<br> <span>' . $title2 .  '</span></h2>';
			echo $map;
			?>

		</section>
	<?php } ?>
</main>
<?php
get_footer();
