<?php
include "load_header.php";
?>

<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h3>Navigation</h3>
            <a href="MyProfile.php" class="sidebar-btn">Profile Info</a>
            <a href="Overview.php" class="sidebar-btn">Overview</a>
            <a href="MyProjects.php" class="sidebar-btn">My Projects</a>
            <a href="EnergyCalculator.php" class="sidebar-btn">Calculators</a>
            <a href="Schedule.php" class="sidebar-btn">Schedule</a>
        </aside>

        <section class="main-content">
            <h1>Schedule Appointment</h1>

            <div class="auth-container schedule-form-container">
                <div class="form-group">
                    <label>Date:</label>
                    <input type="date" id="date">
                </div>

                <div class="form-group">
                    <label>Time:</label>
                    <select id="time" class="form-select">
                        <option value="">Select time</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Service:</label>
                    <select id="service" class="form-select">
                        <option value="consultation">Consultation</option>
                        <option value="installation">Installation</option>
                    </select>
                </div>

                <button id="bookBtn" class="auth-btn">Book Appointment</button>
                <p id="msg" class="status-msg"></p>
            </div>
        </section>
    </div>
</main>

<script src="scripts/schedule.js"></script>
<?php include 'footer.php'; ?>
