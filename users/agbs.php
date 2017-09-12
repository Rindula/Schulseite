<?php
	$file = file_get_contents('./agbs.txt', true);
	if ($file) {
		$toRep = array("\n", "+#", "#+");
		$reps = array("<br>", "<h2>", "</h2>");
		$agbText = str_replace($toRep, $reps, $file);
	}
?>

<head>
	<style>
		#agbs {
			background: #d9eeff;
			width: 100%;
			border-spacing: initial;
			margin: 2px 0px;
			word-break: break-word;
			table-layout: auto;
			line-height: 1.8em;
			color: #333;
			border-radius: 4px;
			padding: 20px 40px;
		}
	</style>
</head>
<body>

	<div id="agbs">
		<?= $agbText ?>
	</div>

</body>