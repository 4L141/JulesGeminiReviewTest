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
            <h1>Carbon Calculator</h1>
            <p>Calculate the carbon footprint of your home based on electricity usage.</p>

            <div class="auth-container calculator-container">
                <form method="post">
                    <div class="form-group">
                        <label>Electricity used (kWh):</label>
                        <input type="number" name="kwh" step="0.1" required>
                    </div>

                    <div class="form-group">
                        <label>CO₂ per kWh (kg):</label>
                        <input type="number" name="factor" step="0.01" value="0.233" required>
                    </div>

                    <button type="submit" class="auth-btn">Calculate</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $kwh = (float)$_POST["kwh"];
                    $factor = (float)$_POST["factor"];
                    $co2 = $kwh * $factor;
                    ?>
                    <div class="result-box">
                        <h3>Result</h3>
                        <p>Electricity used: <strong><?php echo round($kwh, 2); ?> kWh</strong></p>
                        <p>Carbon emissions: <strong><?php echo round($co2, 2); ?> kg CO₂</strong></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
