<?php get_header(); ?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<section class="categories categories--experience">
		<div class="categories__container">
			<?php
			$title = esc_html(get_field('experience_title', 'option'));
			if ($title) echo '<h1 class="categories__title title">' . $title . '</h1>';

			get_template_part('template-parts/common/case-categories-list'); ?>
		</div>
	</section>


</main>

<?php
get_footer();
