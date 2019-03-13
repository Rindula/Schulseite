<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = true;

    // Verifikation des Clients
	include "../../_hidden/verify.php";
	
    // Navigationsleiste
    $pageId = 3;
	include "../../navbar.php";

    // Global Header
	include "../../header.php";

    // Benötigte Variablen
	include "../../_hidden/vars.php";

    // CSS Controller
    $styles[] = "kontakt";
    include "../../css/controller.php";
    
    $dbname = "homeworks";
    include "../../_hidden/mysqlconn.php";
?>
<body class="container<?= ($darkMode) ? " bg-dark text-light" : ""?>">
<?php
    echo "<table class='table table-striped'><tr><th>Name</th><th>Vorname</th><th>E-Mail</th></tr>";
    $sql = "SELECT * FROM lehrer ORDER BY name Asc";
    $statement = $mysqli->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    while ($ar = $result->fetch_assoc()) 
    {
        $vorname = sonderzeichen($ar["vorname"]);
        $name = sonderzeichen($ar["name"]);
        $email = strtolower($vorname).".".strtolower($name)."@fhs-sinsheim.de";
        echo "<tr><td>".$ar["name"]."</td><td>".$ar["vorname"]."</td><td><a href='mailto:".$email."'>".$email."</a></td></tr>";
    }
    echo "</table>";
    include "../../_hidden/bottomScripts.php" ?>
</body>