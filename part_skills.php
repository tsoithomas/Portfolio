
	<h2 class="subtitle">Languages and Tools</h2>
	
	<?php
	$skills=array(
		'Language'=>array(
			'JavaScript','TypeScript','Python','PHP','HTML','CSS','Java',
		),
		'Front-End'=>array(
			'React','Next.js','Vue.js','Tailwind CSS','Mantine','jQuery','Bulma','Bootstrap',
		),
		'Back-End'=>array(
			'Node.js','express.js','Flask'
		),
		'Database'=>array(
			'MySQL','MongoDB','Redis',
		),
		'DevOps'=>array(
			'Azure','AWS','GCP','Docker','Github','Heroku',
		),
		'Data'=>array(
			'pandas','scikit-learn','Jupyter','Tableau','Power BI','Chart.js'
		),
		'Media'=>array(
			'Photoshop','Illustrator','Premiere Pro','InDesign','Audition','Lightroom'
		),
	);

	?>
	<div id="skills">
	<?php
	foreach ($skills as $skill => $tools) {
	?>
		<div class="row">
			<span class="heading"><?php echo htmlspecialchars($skill);?></span>
			<span class="tools"><!--
			--><?php
			foreach ($tools as $tool) {
				$sanitized_tool = strtolower(preg_replace('/[^a-zA-Z]/i', '_', $tool));
				?><!--
				--><acronym title="<?php echo htmlspecialchars($tool);?>"><span class="tool <?php echo $sanitized_tool;?>"></span></acronym><!--
				--><?php
			}//foreach
			?></span>
			<span class="banner"></span>
		</div>
		<?php
	}//foreach
	?>
	</div>

	<div id="leetcard">
		<img id="leet" src="leetcard.php">
	</div>
	