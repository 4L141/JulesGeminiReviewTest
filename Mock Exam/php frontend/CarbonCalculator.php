<?php
include "load_header.php";
?>
<main>
    <h1>Carbon Calculator</h1>
    <p>Calculate the carbon footprint of your home.</p>
    <form method="post">
    <label>
        Electricity used (kWh):
        <input type="number" name="kwh" step="0.1" required>
    </label><br><br>

    <label>
        CO₂ per kWh (kg):
        <input type="number" name="factor" step="0.01" value="0.233" required>
    </label><br><br>

    <button type="submit">Calculate</button>
</form>
</main>
<?php include 'footer.php'; ?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $kwh = (float)$_POST["kwh"];
    $factor = (float)$_POST["factor"];

    $co2 = $kwh * $factor;

    echo "<h2>Result</h2>";
    echo "<p>Electricity used: " . round($kwh, 2) . " kWh</p>";
    echo "<p>Carbon emissions: " . round($co2, 2) . " kg CO₂</p>";
}
