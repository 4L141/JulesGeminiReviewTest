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
            <h1>My Projects</h1>

            <div class="search-bar">
                <input type="text" placeholder="Search projects...">
                <button class="auth-btn">Search</button>
            </div>

            <div class="content-block">
                <table>
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PRJ-001</td>
                            <td>Solar Installation</td>
                            <td>In Progress</td>
                            <td>2023-10-15</td>
                        </tr>
                        <tr>
                            <td>PRJ-002</td>
                            <td>EV Charger Setup</td>
                            <td>Completed</td>
                            <td>2023-09-20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
