<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Panel</title>
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="styles/dashboard.css" rel="stylesheet">
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <!-- normal script imports etc  -->
    <script src="scripts/jquery-1.12.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="scripts/jquery.backstretch.js"></script>
    <!-- Insert this line after script imports -->
    <script>if (window.module) module = window.module;</script>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
    	<div class="navbar-header">
    	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarside" aria-expanded="false" aria-controls="navbarside">
    		<span class="sr-only">Toggle navigation</span>
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    	  </button>

              <div class="navbar-brand"><a href="#">Admin<span>Panel</span></a></div>

    	</div>
    	<div id="navbar" class="navbar-collapse collapse">
    	  <ul class="nav navbar-nav navbar-right">
    		<li><a href="home.php" style="color: #fff">Startseite</a></li>
    		<li><a href="settings.php" style="color: #fff">Einstellungen</a></li>
    		<li><a href="profile.php" style="color: #fff">Profil</a></li>
    		<li><a href="help.php" style="color: #fff">Hilfe</a></li>
    	  </ul>
    	</div>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div id="navbarside" class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
            		<li><a href="home.php">Startseite</a></li>
            		<li><a href="players.php">Spieler</a></li>
            		<li><a href="vehicles.php">Fahrzeuge</a></li>
            		<li><a href="gangs.php">Gruppen</a></li>
            		<li><a href="houses.php">H&auml;user</a></li>
            		<li><a href="logs.php?page=1">Logs</a></li>
                    <li><a href="reimbursement.php">Erstattungsprotokolle</a></li>
            		<li><a href="notesView.php">Notizen</a></li>
            		<li><a href="staff.php">Team</a></li>
            		<li><a href="steam.php">Steam Accounts</a></li>
            		<li><a href="logout.php">Abmelden</a></li>
              </ul>
            </div>
