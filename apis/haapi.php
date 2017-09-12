<?php

$debug = false;
try {
    $errs = 0;
    $nLenght = 2;
    $logText = "=====Log - " . date("H:i:s") . "=====\n";

    function logger($message) {
        global $logText;
        $logText .= $message;
    }

    logger("Abfrage von: ");
    if (isset($_GET["hausaufgaben"])) {
        $dbname = "homeworks";
        include_once "../_hidden/mysqlconn.php";
        try {
            $sqlHausaufgaben = "SELECT * FROM list ORDER BY Datum Asc";
            $resultHausaufgaben = $mysqli->query($sqlHausaufgaben);
            logger("Hausaufgaben\n\n");
            if (gettype($resultHausaufgaben) == "boolean") {
                throw new Exception('MySql Abfrage fehlgeschlagen!');
            }
            while ($row = $resultHausaufgaben->fetch_assoc()) {
                $today = strtotime(date("Y-m-d"));
                $expiration_date = strtotime($row["Datum"]);
                if ($expiration_date < $today) {
                    //logger(str_pad($row["ID"], $nLenght, '0', STR_PAD_LEFT) . " uebersprungen...\n");
                    continue;
                }
                $id = $row['ID'];
                $fach = $row['Fach'];
                $aufgaben = $row['Aufgaben'];
                $datum = strtotime($row["Datum"]);

                $posts[] = array("$id" => array("fach" => $fach, "aufgaben" => $aufgaben, "datum" => $datum));
                logger(str_pad($row["ID"], $nLenght, '0', STR_PAD_LEFT) . " ($datum | $fach) gelistet...\n");
            }
            $resultHausaufgaben->close();
        } catch (Exception $e) {
            $errs++;
            $errloc[] = "Hausaufgaben";
        }
    }
    if (isset($_GET["arbeiten"])) {
        $dbname = "homeworks";
        include_once "../_hidden/mysqlconn.php";
        try {
            $sqlArbeiten = "SELECT * FROM arbeiten ORDER BY datum Asc";
            $resultArbeiten = $mysqli->query($sqlArbeiten);
            logger("Arbeiten\n\n");
            if (gettype($resultArbeiten) == "boolean") {
                throw new Exception('MySql Abfrage fehlgeschlagen!');
            }
            while ($row = $resultArbeiten->fetch_assoc()) {
                $today = strtotime(date("Y-m-d"));
                $expiration_date = strtotime($row["datum"]);
                if ($expiration_date < $today) {
                    //logger(str_pad($row["id"], $nLenght, '0', STR_PAD_LEFT) . " uebersprungen...\n");
                    continue;
                }
                $sql2 = "SELECT fach FROM flist WHERE id = ?";
                $statement2 = $mysqli->prepare($sql2);
                $statement2->bind_param("i", $row['fach']);
                $statement2->execute();
                list($fach) = $statement2->get_result()->fetch_array();
                $id = $row['id'];
                $aufgaben = $row['themen'];
                $datum = strtotime($row["datum"]);

                $posts[] = array("$id" => array("fach" => $fach, "themen" => $aufgaben, "datum" => $datum));
                logger(str_pad($row["id"], $nLenght, '0', STR_PAD_LEFT) . " ($datum | $fach) gelistet...\n");
            }
            $resultArbeiten->close();
        } catch (Exception $e) {
            $errs++;
            $errloc[] = "Arbeiten";
        }
    }
    if (isset($_GET["termine"])) {
        $dbname = "stats";
        include_once "../_hidden/mysqlconn.php";
        try {
            $sqlTermine = "SELECT * FROM termine ORDER BY datum Asc";
            $resultTermine = $userConn->query($sqlTermine);
            logger("Termine\n\n");
            if (gettype($resultTermine) == "boolean") {
                throw new Exception('MySql Abfrage fehlgeschlagen!');
            }
            while ($row = $resultTermine->fetch_assoc()) {
                $today = strtotime(date("Y-m-d"));
                $expiration_date = strtotime($row["datum"]);
                if ($expiration_date < $today) {
                    //logger(str_pad($row["id"], $nLenght, '0', STR_PAD_LEFT) . " uebersprungen...\n");
                    continue;
                }
                $id = $row['id'];
                $typ = $row['typ'];
                $raum = $row['raum'];
                $datum = strtotime($row["datum"]);

                $posts[] = array("$id" => array("raum" => $raum, "typ" => $typ, "datum" => $datum));
                logger(str_pad($row["id"], $nLenght, '0', STR_PAD_LEFT) . " ($datum | $typ | $raum) gelistet...\n");
            }
            $resultTermine->close();
        } catch (Exception $e) {
            $errs++;
            $errloc[] = "Termine";
        }
    }

    try {
        if ($debug) {
            print_r($posts);
        }
        echo json_encode($posts, JSON_UNESCAPED_UNICODE);
    } catch (Exception $exc) {
        logger($exc->getTraceAsString());
    }



    if (count($errloc) > 0) {
        logger("\n====================\nFehlermeldung\n====================\nEs gab in Folgenden breiechen Fehler:\n");
        for ($i = 0; $i < count($errloc); $id++) {
            logger($errloc[$i] . "\n");
        }
        logger("====================\n");
    }

    $fpLog = fopen("C:\\inetpub\\vhosts\\diemalztiere.de\\httpdocs\\apis\\logs\\log_" . date("Y-m-d") . ".txt", 'a');
    fwrite($fpLog, $logText . "\n");
    fclose($fpLog);
} catch (Exception $exc) {
    die("<pre>" . $exc->getTraceAsString() . "</pre>");
}
?>