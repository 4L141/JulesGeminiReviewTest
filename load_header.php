<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    include "header_guest.php";
} elseif ($_SESSION["role"] === "admin") {
    include "header_admin.php";
} else {
    include "header_user.php";
}
