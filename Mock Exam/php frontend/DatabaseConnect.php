<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "rolsatechnologies";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}
