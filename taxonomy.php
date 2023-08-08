<?php get_header(); ?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<div class="page__container">
		<?php the_content() ?>
	</div>

</main>
<?php
get_footer();
