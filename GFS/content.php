<?php

$page = $_GET["page"];

if (file_exists("pages/page_" . $page . ".html")) {
    include "pages/page_" . $page . ".html";
} else {
    include "pages/end.html";
}