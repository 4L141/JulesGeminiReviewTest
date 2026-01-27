<?php
include "load_header.php";
include 'backend_call.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $pkCol = $_POST['primary_key'];
    $pkVal = $_POST['primary_value'];

    $response = callBackend([
        "Action" => "delete_row",
        "table" => $table,
        "primary_key" => $pkCol,
        "primary_value" => $pkVal
    ]);

    header("Location: view_table.php?table=" . urlencode($table));
    exit;
} else {
    die("Invalid request");
}
