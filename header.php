<?php
setlocale(LC_TIME, 'german', 'deu_deu', 'deu', 'de_DE', 'de');
$pageTitle = "Svens Homepage";
if (isset($title)) {
	echo "<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>$title | $pageTitle</title>
		<link rel='shortcut icon' href='http://edge.sf.hitbox.tv/static/img/channel/Rindula_54848ba194189_large.jpg'>
	</head>";
} else {
echo "<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>$pageTitle</title>
		<link rel='shortcut icon' href='http://edge.sf.hitbox.tv/static/img/channel/Rindula_54848ba194189_large.jpg'>
	</head>";
};
header('Content-Type: text/html; charset=utf-8');
?>