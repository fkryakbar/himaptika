<?php
require_once "variable/absolute.php";

$url = ["home", "index"];
if (isset($_GET["method"])) {
    $url = rtrim($_GET["method"], "/");
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode("/", $url);
}

// cek method
if ($url[0] == "home") {
    require_once "views/" . "home" . ".php";
} elseif ($url[0] == "blog") {
    require_once "views/" . $url[0] . ".php";
} elseif ($url[0] == "login") {
    require_once "views/login.php";
} elseif ($url[0] == "edit") {
    require_once "views/edit.php";
} elseif ($url[0] == "sosial") {
    require_once "views/sosial.php";
} elseif ($url[0] == "gebyar-matematika-2022") {
    require_once "views/gm.php";
} else {
    require_once "views/notfound.php";
}
