<?php

/**
template name: Цены
 */
get_header(); ?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<?php
	get_template_part('template-parts/price/price_template');
	get_template_part('template-parts/price/callback_template');
	?>

</main>
<?php
get_footer();
