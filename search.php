<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package incon
 */

get_header();
?>

<main class="page page--gray">
	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<section class="page__container">

		<?php if (have_posts()) : ?>
			<h1 class="title" style="margin-bottom: 6rem;">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Результаты поиска: %s', 'incon'),  get_search_query());
				?>
			</h1>
		<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				the_content();
			endwhile;

			the_posts_navigation();

		else :

			echo '<h2 class="title">Поиск не дал результатов</h2>';

		endif;
		?>
	</section><!-- .page-header -->
</main>

<?php
get_footer();
