<?php

/**
template name: Главная
 */

get_header();
?>

<main class="page">

	<?php
	get_template_part('template-parts/home/intro_template');
	get_template_part('template-parts/home/about_template');
	get_template_part('template-parts/home/cases_template');
	get_template_part('template-parts/home/articles_template');
	get_template_part('template-parts/home/video_block_template');
	get_template_part('template-parts/home/adv_template');
	get_template_part('template-parts/home/chart_template');
	get_template_part('template-parts/home/callback_template');
	?>
</main>
<?php
get_footer();
