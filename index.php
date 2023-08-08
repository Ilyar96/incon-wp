<?php

/**
 * News
 */
get_header();
?>

<main class="page page--gray">

	<!-- Breadcrumb -->
	<div class="breadcrumbs">
		<?php incon_get_breadcrumbs() ?>
	</div>
	<!-- /Breadcrumb -->

	<?php if (single_post_title('', false)) { ?>
		<section class="page__container">
			<h1 class="page__title title"><?php esc_html(single_post_title()); ?></h1>
		</section>
	<?php } ?>

	<?php
	get_template_part('template-parts/common/post-template');
	get_template_part('template-parts/common/investment-sources-template');
	?>

</main>
<?php
get_footer();
