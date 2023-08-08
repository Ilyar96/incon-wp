<?php

/**
template name: О компании
 */
get_header(); ?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<?php
	get_template_part('template-parts/about-company/intro-template');
	get_template_part('template-parts/about-company/video-block-template');
	get_template_part('template-parts/about-company/about-company-template');
	get_template_part('template-parts/about-company/team-template');
	get_template_part('template-parts/about-company/history-template');
	?>
</main>
<?php
get_footer();
