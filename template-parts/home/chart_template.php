<?php
$is_display = get_field('is_display_charts');
$title1 = wp_kses_post(get_field('chart_title1'));
$title2 = wp_kses_post(get_field('chart_title2'));
$diagram1 = get_Field('diagram1', get_the_ID())['options'];
$diagram2 = get_Field('diagram2', get_the_ID())['options'];
$diagram3 = get_Field('diagram3', get_the_ID())['options'];
if ($is_display) {
?>
	<section class="charts">
		<div class="charts__container row">
			<?php if ($diagram1) { ?>
				<div class="charts__col-left col">
					<?php if ($title1) echo '<h2 class="charts__title">' . $title1 . '</h2>'; ?>
					<canvas class="charts__diag1" id="yeardiag"></canvas>
				</div>
			<?php }
			if ($diagram2 || $diagram3) { ?>
				<div class="charts__col-right col">
					<?php if ($title2) echo '<h2 class="charts__title charts__title--white">' . $title2 . '</h2>'; ?>
					<div class="charts__diagrams">
						<?php if ($diagram2) { ?>
							<div c class="charts__diag2">
								<canvas id="projectsdiag1"></canvas>
							</div>
						<?php }

						if ($diagram3) { ?>
							<div class="charts__diag3">
								<canvas id="projectsdiag2"></canvas>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>