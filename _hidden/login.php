<?php
session_start();
include "vars.php";
$pageId = 7;
include "../navbar.php";
include "../css/controller.php";
$pdo = new PDO('mysql:host=localhost;dbname=stats', 'root', "WQeYt4S8G3");

if (isset($_GET['login'])) {
    $name = $_POST['name'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE login = :name");
    $result = $statement->execute(array('name' => $name));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['group'] = $user['gruppe'];
        $_SESSION['name'] = $user['vorname'] . " " . $user["name"];
        $_SESSION["colors"][0] = $user["navbarBack"];
        $_SESSION["colors"][1] = $user["navbarText"];
        $_SESSION["colors"][2] = $user["backgroundPage"];
        $success = '1';
        $errorMessage = "<meta http-equiv='refresh' content='1; " . $_SESSION["url"] . "'><h1>Login erfolgreich. Weiterleitung erfolgt...</h1>";
    } else {
        $success = '0';
        $errorMessage = "Name oder Passwort war ungültig<br>";
    }
    $log = "Details: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
            "Attempt: " . ($success == '1' ? 'Erfolgreich' : '<<Fehlgeschlagen>>') . PHP_EOL .
            "User: " . $name . PHP_EOL .
            ($success != '1' ? 'Pass: # correct #' : 'Pass: ' . $passwort) . PHP_EOL .
            "-------------------------" . PHP_EOL;
    file_put_contents('../log/loginlog_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
};
?>
<!DOCTYPE html> 
<html> 
    <head>
        <title>Login Seite</title> 
        <style>
            * { box-sizing:border-box; }

            /* basic stylings ------------------------------------------ */
            .container 		{ 
                font-family:'Roboto';
                width:600px; 
                margin:30px auto 0; 
                display:block; 
                padding:10px 50px 50px;
            }
            h2 		 { 
                text-align:center; 
                margin-bottom:50px; 
            }
            h2 small { 
                font-weight:normal; 
                color:#3cb1dd; 
                display:block; 
            }
            .footer 	{ text-align:center; }
            .footer a  { color:#53B2C8; }

            /* form starting stylings ------------------------------- */
            .group 			  { 
                position:relative; 
                margin-bottom:45px; 
            }
            input 				{
                font-size:18px;
                padding:10px 10px 10px 5px;
                display:block;
                width:300px;
                border:none;
                border-bottom:1px solid #757575;
                background-color: rgba(224, 224, 224, 0.4);
            }
            input[type="submit"] {
                background-color: #d6d6d6;
            }
            input:focus 		{ outline:none; }

            /* LABEL ======================================= */
            label 				 {
                color:#999; 
                font-size:18px;
                font-weight:normal;
                position:absolute;
                pointer-events:none;
                left:5px;
                top:10px;
                transition:0.2s ease all; 
                -moz-transition:0.2s ease all; 
                -webkit-transition:0.2s ease all;
            }

            /* active state */
            input:focus ~ label, input:valid ~ label 		{
                top:-20px;
                font-size:14px;
                color:#ffa700;
            }

            /* BOTTOM BARS ================================= */
            .bar 	{ position:relative; display:block; width:300px; }
            .bar:before, .bar:after 	{
                content:'';
                height:2px; 
                width:0;
                bottom:1px; 
                position:absolute;
                background:#ffa700; 
                transition:0.2s ease all; 
                -moz-transition:0.2s ease all; 
                -webkit-transition:0.2s ease all;
            }
            .bar:before {
                left:50%;
            }
            .bar:after {
                right:50%; 
            }

            /* active state */
            input:focus ~ .bar:before, input:focus ~ .bar:after {
                width:50%;
            }

            /* HIGHLIGHTER ================================== */
            .highlight {
                position:absolute;
                height:60%; 
                width:100px; 
                top:25%; 
                left:0;
                pointer-events:none;
                opacity:0.5;
            }

            /* active state */
            input:focus ~ .highlight {
                -webkit-animation:inputHighlighter 0.3s ease;
                -moz-animation:inputHighlighter 0.3s ease;
                animation:inputHighlighter 0.3s ease;
            }

            /* ANIMATIONS ================ */
            @-webkit-keyframes inputHighlighter {
                from { background:#5264AE; }
                to 	{ width:0; background:transparent; }
            }
            @-moz-keyframes inputHighlighter {
                from { background:#5264AE; }
                to 	{ width:0; background:transparent; }
            }
            @keyframes inputHighlighter {
                from { background:#5264AE; }
                to 	{ width:0; background:transparent; }
            }

            .error {
                text-align: center;
                padding: 10px;
                background-color: rgba(1,0,0,0.4);
            }
        </style>
    </head> 
    <body>

        <?php
        if (isset($errorMessage)) {
            echo "<span class='error'>$errorMessage</span>";
        };
        ?>

        <div class="container">

            <h2>Login Seite <small>Interner Bereich</small></h2>

            <form action="?login" method="post">

                <div class="group">
                    <input name="name" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Name</label>
                </div>

                <div class="group">
                    <input name="passwort" type="password" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Passwort</label>
                </div>

                <input type="submit" value="Abschicken">

            </form>

        </div>
    </body>
</html>