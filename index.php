<?php $needVerify = false; include "_hidden/verify.php"; include "_hidden/vars.php"; $darkMode = ($_COOKIE["darkmode"] == "true") ? true : false; ?>
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
				txt = "<table class='table <?= ($darkMode) ? "table-dark" : "table-light"; ?> table-striped'><thead><tr><th></th><th>Änderung</th><th>Zeitpunkt</th></tr></thead><tbody>"
				for (x in myObj) {
					var date = new Date(myObj[x].commit.author.date);
					var d = ("0" + date.getDate()).slice(-2) + "." + ("0" + (date.getMonth() + 1)).slice(-2) + "." + date.getFullYear() + ", " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2);

					var message = myObj[x].commit.message.split("\n\n");
					if (message.length > 2) {
						for (let i = 2; i < message.length; i++) {
							message[1].concat("\n" + message[i]);
							
						}
					}
					if (message.length == 1) {
						message[1] = "";
					}

					txt += "<tr><td><img title='"+myObj[x].commit.author.name+"' class='rounded-circle' height='25' src='"+myObj[x].author.avatar_url+"'></td><td><h2>" + message[0] + "</h2><br>" + message[1] + "</td><td>" + d + "</td></tr>";
				}
				txt += "</tbody></table>";
				document.getElementById("changelog").innerHTML = txt.replace(/\n/g, "<br />");
			} else {
				document.getElementById("changelog").innerHTML = "<h1>Fehler beim laden des Changelogs!</h1>";
			}
		}
	}
	xhttp.open("GET", "https://api.github.com/repos/Rindula/Schulseite/commits?page=1&per_page=1000", true);
	xhttp.send(null);
</script>
</head>

<body class="container">
<?php include "navbar.php" ?>
<div>
<h2 class="display-2">Changelog</h2>
<div id="changelog"></div>
</div>
<?php include "_hidden/bottomScripts.php" ?>
</body>
</html>
