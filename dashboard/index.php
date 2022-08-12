<?php
require_once "../variable/absolute.php";
session_start();
if (!$_SESSION["login"] == "islogin") {
    header("Location:" . BASELINK . "login");
    exit;
} else {
    header("Location:" . BASELINK . "dashboard/main");
}
