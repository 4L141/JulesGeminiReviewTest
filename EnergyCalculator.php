<?php
include "load_header.php";
?>

<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h3>Calculators</h3>
            <a href="EnergyCalculator.php" class="sidebar-btn">Energy Usage</a>
            <a href="CarbonCalculator.php" class="sidebar-btn">Carbon Footprint</a>
        </aside>

        <section class="main-content">
            <h1>Energy Calculator</h1>
            <p>Calculate the energy usage of your home and estimate costs.</p>

            <div class="auth-container calculator-container">
                <form method="post">
                    <div class="form-group">
                        <label>Power (kW):</label>
                        <input type="number" name="power" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label>Hours per day:</label>
                        <input type="number" name="hours" step="0.1" required>
                    </div>

                    <div class="form-group">
                        <label>Number of days:</label>
                        <input type="number" name="days" required>
                    </div>

                    <div class="form-group">
                        <label>Cost per kWh (€):</label>
                        <input type="number" name="rate" step="0.01" required>
                    </div>

                    <button type="submit" class="auth-btn">Calculate</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $power = (float)$_POST["power"];
                    $hours = (float)$_POST["hours"];
                    $days = (int)$_POST["days"];
                    $rate = (float)$_POST["rate"];

                    $totalKwh = $power * $hours * $days;
                    $totalCost = $totalKwh * $rate;
                    ?>
                    <div class="result-box">
                        <h3>Result</h3>
                        <p>Total energy used: <strong><?php echo round($totalKwh, 2); ?> kWh</strong></p>
                        <p>Total cost: <strong>€<?php echo round($totalCost, 2); ?></strong></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
