<?php get_header(); ?>

<main class="page page--case">

	<?php
	$term = get_the_terms(get_the_ID(), 'case-category')[0];
	$termId = $term->term_id;
	$term_name = $term->name;
	$term_link = get_term_link($termId);
	?>
	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs($term_link, $term_name) ?>
	</div>
	<!-- /Breadcrumb -->

	<?php the_content(); ?>
</main>
<?php
get_footer();
