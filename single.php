<?php
get_header();
setPostViews(get_the_ID()); //Считывает кол-во просмотров
?>
<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<?php if (current_user_can('administrator')) { ?>
		<div class="views" style="margin-top: 5rem;">
			<div class="views__container">
				<h2><strong>Просмотров</strong> (Видно только администраторам): <?php echo getPostViews((int)get_the_ID()); ?></h2>
			</div>
		</div>
	<?php } ?>

	<section class="news news--single">
		<div class="news__container" data-spollers="991,max">
			<div class="news__body">
				<div class="news__header">
					<h1 class="news__title"><?php echo esc_html(get_the_title()) ?></h1>
					<div class="news__date"><?php echo get_the_date() ?></div>
					<?php
					if (count(get_tags()) > 0) { ?>
						<div class="news__tags">
							<?php the_tags('<div class="news__tag tag-block">', '</div><div class="news__tag tag-block">', '</div>'); ?>
						</div>
					<?php } ?>
				</div>

				<article class="news__article editor-block">
					<img class="lazy" src="<?php echo get_template_directory_uri() ?>/img/icons/empty.png" data-src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_html(get_the_title()) ?>">
					<?php the_content(); ?>
				</article>
			</div>
			<?php echo get_sidebar(); ?>
		</div>
	</section>
</main>
<?php
get_footer();
