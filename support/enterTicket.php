<?php


$conn = new mysqli("25.83.12.108", "root", "SiSal2002", "support");
$conn->query("SET NAMES 'utf8'");

$von = $conn->real_escape_string($_POST["name"]);
$text = $conn->real_escape_string($_POST["text"]);
$system = $conn->real_escape_string($_POST["system"]);

$conn->query("INSERT INTO tickets (text, system, von) VALUES ('$text', '$system', '$von')");