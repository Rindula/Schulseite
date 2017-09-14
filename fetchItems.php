<?php

$gdvdv = new mysqli("localhost", "root", "WQeYt4S8G3", "homeworks");
$edrhf = new mysqli("localhost", "root", "WQeYt4S8G3", "stats");

$ret = $gdvdv->query("SELECT * FROM flist ORDER BY fach");

while($list = $ret->fetch_assoc()) {
    echo "<option value='".$list["id"]."'>".$list["fach"]."</option>";

}