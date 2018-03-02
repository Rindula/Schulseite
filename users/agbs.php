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
			width: 50%;
			border-spacing: initial;
			margin: auto;
			word-break: break-word;
			table-layout: auto;
			line-height: 1.8em;
			color: #333;
			border-radius: 4px;
			padding: 20px 40px;
			display: block;
			
		}
	</style>
	<title>AGBs | rindula.de</title>
	<?php include "../css/controller.php"; include "../_hidden/vars.php"; include "../_hidden/verify.php"; ?>
</head>
<body>
	<?php include "../navbar.php" ?>
	<div id="agbs">
		<?= $agbText ?>
	</div>
<?php include "../_hidden/bottomScripts.php"; ?>
</body>