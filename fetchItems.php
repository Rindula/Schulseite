<?php

$gdvdv = new mysqli("localhost", "root", "WQeYt4S8G3", "homeworks");
$edrhf = new mysqli("localhost", "root", "WQeYt4S8G3", "stats");

$ret = $gdvdv->query("SELECT * FROM flist ORDER BY fach");

function getFach($id)
{
    global $edrhf;
    $ct_lessons = array(10, 11);
    $re_lessons = array(9,18,19);
    $fr_lessons = array(6,16);
    $sk_lessons = array(17);
    $bk_lessons = array(13);
    $pc_lessons = array(8, 12);
    if (in_array($id, $ct_lessons)) {
        $fetch = $edrhf->query("SELECT ct FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 2 && $id == 10)
            return true;
        if($r[0] == 1 && $id == 11)
            return true;
        return false;
    }
    if (in_array($id, $re_lessons)) {
        $fetch = $edrhf->query("SELECT re FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 0 && $id == 9)
            return true;
        if($r[0] == 1 && $id == 19)
            return true;
        if($r[0] == 2 && $id == 18)
            return true;
        return false;
    }
    if (in_array($id, $fr_lessons)) {
        $fetch = $edrhf->query("SELECT fr FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 1 && $id == 6)
            return true;
        if($r[0] == 2 && $id == 16)
            return true;
        return false;
    }
    if (in_array($id, $sk_lessons)) {
        $fetch = $edrhf->query("SELECT sk FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 1 && $id == 17)
            return true;
        return false;
    }
    if (in_array($id, $bk_lessons)) {
        $fetch = $edrhf->query("SELECT bk FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 1 && $id == 13)
            return true;
        return false;
    }
    if (in_array($id, $pc_lessons)) {
        $fetch = $edrhf->query("SELECT pc FROM users WHERE id=" . $_SESSION["userid"]);
        $r = $fetch->fetch_array();
        if($r[0] == 0 && $id == 8)
            return true;
        if($r[0] == 1 && $id == 12)
            return true;
        return false;
    }

    return true;
}

while ($list = $ret->fetch_assoc()) {
    if (!getFach($list["id"])) {
        echo "<option value='".$list["id"]."'>".$list["fach"]."</option>";
    }
}
