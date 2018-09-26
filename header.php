<?php
setlocale(LC_TIME, 'german', 'deu_deu', 'deu', 'de_DE', 'de');
if ($darkMode) {
	$color = "#343a40";
} else {
	$color = "#f8f9fa";
}
$pageTitle = "rindula.de";
if (isset($title)) {
	echo "
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>$title | $pageTitle</title>
		<meta name='theme-color' content='$color'>
		<link rel='shortcut icon' href='/favicon.ico'>
	</head>";
} else {
echo "
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>$pageTitle</title>
		<meta name='theme-color' content='$color'>
		<link rel='shortcut icon' href='/favicon.ico'>
	</head>";
};
header('Content-Type: text/html; charset=utf-8');
?>
