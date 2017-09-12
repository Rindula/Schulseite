<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Datum in der Vergangenheit
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GFS Präsentation</title>
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="../styles/loader.css">
        <link rel="stylesheet" href="styles/pages.css">
        <!-- JQuery Script von Google -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Mein Ajax Script -->
        <script src="scripts/ajax.js"></script>
        <!-- Mein Key Input Manager -->
        <script src="scripts/keys.js"></script>
        <!-- Und mein Preloadmanager -->
        <script src="scripts/preload.js"></script>
    </head>
    <body onload="callPage(page)">
        <div id="content">
            <?php include 'pages/loader.html'; ?>
        </div>
    </body>
</html>
