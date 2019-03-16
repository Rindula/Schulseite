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
    $sql = "SELECT lehrer.name, lehrer.vorname, lehrer.geschlecht FROM lehrer WHERE lehrer.name != \"\" AND lehrer.vorname != \"\" ORDER BY lehrer.name";
    $statement = $mysqli->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    while ($ar = $result->fetch_assoc()) 
    {
        $vorname = sonderzeichen($ar["vorname"]);
        $name = sonderzeichen($ar["name"]);
        $email = strtolower($vorname).".".strtolower($name)."&#64;fhs-sinsheim.de";
        echo "<tr><td>".$ar["name"]."</td><td>".$ar["vorname"]."</td><td><a class='btn btn-info btn-block' href='mailto:".$email."?body=Hallo%20".(($ar["geschlecht"] == "m") ? "Herr" : "Frau")." ".$ar["name"].",%0D%0A%0D%0A'>".(($ar["geschlecht"] == "m") ? "Herrn" : "Frau")." ".$ar["name"]." anschreiben</a></td></tr>";
    }
    echo "</table>";
    include "../../_hidden/bottomScripts.php" ?>
</body>