<?php
include "load_header.php";
?>
<main>
    <h1>Energy Calculator</h1>
    <p>Calculate the energy usage of your home.</p>
    <form method="post">
    <label>
        Power (kW):
        <input type="number" name="power" step="0.01" required>
    </label><br><br>

    <label>
        Hours per day:
        <input type="number" name="hours" step="0.1" required>
    </label><br><br>

    <label>
        Number of days:
        <input type="number" name="days" required>
    </label><br><br>

    <label>
        Cost per kWh (€):
        <input type="number" name="rate" step="0.01" required>
    </label><br><br>

    <button type="submit">Calculate</button>
</form>
</main>
<?php include 'footer.php'; ?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $power = (float)$_POST["power"];
    $hours = (float)$_POST["hours"];
    $days = (int)$_POST["days"];
    $rate = (float)$_POST["rate"];

    $totalKwh = $power * $hours * $days;
    $totalCost = $totalKwh * $rate;

    echo "<h2>Result</h2>";
    echo "<p>Total energy used: " . round($totalKwh, 2) . " kWh</p>";
    echo "<p>Total cost: €" . round($totalCost, 2) . "</p>";
}
