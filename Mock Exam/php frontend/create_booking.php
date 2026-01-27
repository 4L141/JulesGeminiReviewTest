<?php
session_start();
// Include the file that contains the function definition
include "backend_call.php";

$date = $_POST["date"] ?? "";
$time = $_POST["time"] ?? "";
$service = $_POST["service"] ?? "";

$request = [
    "Action" => "create_booking",
    "user_id" => $_SESSION["id"],
    "service" => $_POST["service"],
    "date"    => $_POST["date"],
    "time"    => $_POST["time"]
];
// FIX: Call the function and assign the result to $response
$response = callBackend($request);

// Now $response["Message"] will exist [cite: 316]
echo $response["Message"] ?? "No response from server";