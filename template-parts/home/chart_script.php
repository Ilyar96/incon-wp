<?php
//diagram1
$diagram1 = get_Field('diagram1', get_the_ID())['options'];
$diagram1_labels = [];
$diagram1_values = [];
$diagram1_colors = [];

//diagram2
$diagram2 = get_Field('diagram2', get_the_ID())['options'];
$diagram2_rotation = json_encode(get_Field('diagram2', get_the_ID())['rotation']);
$diagram2_labels = [];
$diagram2_values = [];
$diagram2_colors = [];

//diagram3
$diagram3 = get_Field('diagram3', get_the_ID())['options'];
$diagram3_rotation = json_encode(get_Field('diagram3', get_the_ID())['rotation']);
$diagram3_labels = [];
$diagram3_values = [];
$diagram3_colors = [];

//diagram1
if ($diagram1) {
	foreach ($diagram1 as $item) {
		array_push($diagram1_labels, $item['label']);
		array_push($diagram1_values, $item['value']);
		array_push($diagram1_colors, $item['color']);
	}

	$diagram1_labels = json_encode($diagram1_labels);
	$diagram1_values = json_encode($diagram1_values);
	$diagram1_colors = json_encode($diagram1_colors);
}

//diagram2
if ($diagram2) {
	foreach ($diagram2 as $item) {
		array_push($diagram2_labels, $item['label']);
		array_push($diagram2_values, $item['value']);
		array_push($diagram2_colors, $item['color']);
	}

	$diagram2_labels = json_encode($diagram2_labels);
	$diagram2_values = json_encode($diagram2_values);
	$diagram2_colors = json_encode($diagram2_colors);
}

//diagram3
if ($diagram3) {
	foreach ($diagram3 as $item) {
		array_push($diagram3_labels, $item['label']);
		array_push($diagram3_values, $item['value']);
		array_push($diagram3_colors, $item['color']);
	}

	$diagram3_labels = json_encode($diagram3_labels);
	$diagram3_values = json_encode($diagram3_values);
	$diagram3_colors = json_encode($diagram3_colors);
}
?>
<script>
	const rotation2 = <?php echo $diagram2_rotation ?>;
	const rotation3 = <?php echo $diagram3_rotation ?>;

	//External tooltip
	const getOrCreateTooltip = (chart) => {
		let tooltipEl = chart.canvas.parentNode.querySelector('div');

		if (!tooltipEl) {
			tooltipEl = document.createElement('div');
			tooltipEl.classList.add('custom-tooltip');
			tooltipEl.style.background = 'rgba(0, 0, 0, 0.7)';
			tooltipEl.style.borderRadius = '3px';
			tooltipEl.style.color = 'white';
			tooltipEl.style.opacity = 1;
			tooltipEl.style.pointerEvents = 'none';
			tooltipEl.style.position = 'absolute';
			tooltipEl.style.transform = 'translate(-50%, 0)';
			tooltipEl.style.transition = 'all .1s ease';

			const table = document.createElement('table');
			table.style.margin = '0px';

			tooltipEl.appendChild(table);
			chart.canvas.parentNode.appendChild(tooltipEl);
		}

		return tooltipEl;
	};
	const externalTooltipHandler = (context) => {
		// Tooltip Element
		const {
			chart,
			tooltip
		} = context;
		const tooltipEl = getOrCreateTooltip(chart);

		// Hide if no tooltip
		if (tooltip.opacity === 0) {
			tooltipEl.style.opacity = 0;
			return;
		}

		// Set Text
		if (tooltip.body) {
			const titleLines = tooltip.title || [];
			const bodyLines = tooltip.body.map(b => b.lines);

			const tableHead = document.createElement('thead');

			titleLines.forEach(title => {
				const tr = document.createElement('tr');
				tr.style.borderWidth = 0;

				const th = document.createElement('th');
				th.style.borderWidth = 0;
				const text = document.createTextNode(title);

				th.appendChild(text);
				tr.appendChild(th);
				tableHead.appendChild(tr);
			});

			const tableBody = document.createElement('tbody');
			bodyLines.forEach((body, i) => {
				const colors = tooltip.labelColors[i];

				const span = document.createElement('span');
				span.style.background = colors.backgroundColor;
				span.style.borderColor = colors.borderColor;
				span.style.borderWidth = '0.2rem';
				span.style.marginRight = '1rem';
				span.style.height = '1rem';
				span.style.width = '1rem';
				span.style.display = 'inline-block';

				const tr = document.createElement('tr');
				tr.style.backgroundColor = 'inherit';
				tr.style.borderWidth = 0;

				const td = document.createElement('td');
				td.style.borderWidth = 0;

				const text = document.createTextNode(body);

				td.appendChild(span);
				td.appendChild(text);
				tr.appendChild(td);
				tableBody.appendChild(tr);
			});

			const tableRoot = tooltipEl.querySelector('table');

			// Remove old children
			while (tableRoot.firstChild) {
				tableRoot.firstChild.remove();
			}

			// Add new children
			tableRoot.appendChild(tableHead);
			tableRoot.appendChild(tableBody);
		}

		const {
			offsetLeft: positionX,
			offsetTop: positionY
		} = chart.canvas;

		// Display, position, and set styles for font
		tooltipEl.style.opacity = 1;
		tooltipEl.style.left = positionX + tooltip.caretX + 'px';
		tooltipEl.style.top = positionY + tooltip.caretY + 'px';
		tooltipEl.style.font = tooltip.options.bodyFont.string;
		tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
	};

	<?php if ($diagram1) { ?>
		const ctx1 = document.getElementById('yeardiag');
		const yval_temporary = <?php echo $diagram1_values ?>;
		const yeardiag = new Chart(ctx1, {
			type: 'bar',
			data: {
				labels: <?php echo $diagram1_labels ?>,
				datasets: [{
					label: '',
					data: yval_temporary,
					backgroundColor: <?php echo $diagram1_colors ?>,
					borderColor: <?php echo $diagram1_colors ?>,
					borderWidth: 1
				}]
			},
			options: {
				animation: {
					duration: 3000
				},
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						enabled: false,
						position: 'average',
						external: externalTooltipHandler
					}
				},
				responsive: true,
				aspectRatio: 2,
			}
		});
	<?php }
	if ($diagram2) { ?>

		const ctx2 = document.getElementById("projectsdiag1");
		const projectsdiag1 = new Chart(ctx2, {
			type: 'doughnut',
			data: {
				labels: <?php echo $diagram2_labels ?>,
				datasets: [{
					label: '',
					data: <?php echo $diagram2_values ?>,
					backgroundColor: <?php echo $diagram2_colors ?>
				}]
			},
			options: {
				rotation: rotation2 * Math.PI,
				animation: {
					duration: 1500
				},
				aspectRatio: 1,
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						enabled: false,
						position: 'average',
						external: externalTooltipHandler
					}
				},
				responsive: true,
			}
		});
	<?php }

	if ($diagram3) { ?>
		const ctx3 = document.getElementById("projectsdiag2");
		const projectsdiag2 = new Chart(ctx3, {
			type: 'doughnut',
			data: {
				labels: <?php echo $diagram3_labels ?>,
				datasets: [{
					label: '',
					data: <?php echo $diagram3_values ?>,
					backgroundColor: <?php echo $diagram3_colors ?>
				}]
			},
			options: {
				rotation: rotation3 * Math.PI,
				animation: {
					duration: 1500
				},
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						enabled: false,
						position: 'average',
						external: externalTooltipHandler
					}
				},
				responsive: true,
			}

		});
	<?php } ?>
</script>