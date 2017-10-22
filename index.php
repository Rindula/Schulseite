<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Startseite</title>
<?php include "css/controller.php" ?>
<script>
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == XMLHttpRequest.DONE) {
			if (xhttp.status == 200) {
				myObj = JSON.parse(this.responseText);
				txt = "<table class='table table-light table-striped'><thead><tr><th>Änderung</th><th>Zeitpunkt</th></tr></thead><tbody>"
				for (x in myObj) {
					var date = new Date(myObj[x].commit.author.date)
					var d = date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear() + ", " + date.getHours() + ":" + date.getMinutes()
					txt += "<tr><td>" + myObj[x].commit.message + "</td><td>" + d + "</td></tr>";
				}
				txt += "</tbody></table>";
				document.getElementById("changelog").innerHTML = txt;
			} else {
				document.getElementById("changelog").innerHTML = "<h1>Fehler beim laden des Changelogs!</h1>";
			}
		}
	}
	xhttp.open("GET", "https://api.github.com/repos/Rindula/Schulseite/commits", true);
	xhttp.send(null);
</script>
</head>

<body>
<?php include "navbar.php" ?>
<h1 class="display-1">Changelog</h1>
<div id="changelog"></div>
<?php include "_hidden/bottomScripts.php" ?>
</body>
</html>
