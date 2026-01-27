<?php
$date = $_GET["date"];
$allSlots = ["08:00:00", "12:00:00", "15:00:00"];

$request = [
    "Action" => "get_booked_times",
    "date" => $date
];

include "backend_call.php";

// FIX: Call the function
$response = callBackend($request);

$booked = [];
if (isset($response["Rows"]) && is_array($response["Rows"])) {
    foreach ($response["Rows"] as $row) {
        if (!empty($row["schedule_date"])) {
            $dt = new DateTime($row["schedule_date"]);
            $booked[] = $dt->format("H:i:s");
        }
    }
}

$available = array_values(array_diff($allSlots, $booked));
echo json_encode($available);