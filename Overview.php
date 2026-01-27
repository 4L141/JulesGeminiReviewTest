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
            <h1>Overview</h1>

            <div class="search-bar">
                <input type="text" placeholder="Search project overview...">
                <button class="auth-btn">Search</button>
            </div>

            <div class="content-block">
                <p>Welcome to your project overview. Here you can see a summary of all your active services.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total Units</th>
                            <th>Efficiency</th>
                            <th>Impact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Solar Panels</td>
                            <td>12</td>
                            <td>94%</td>
                            <td>High</td>
                        </tr>
                        <tr>
                            <td>EV Chargers</td>
                            <td>1</td>
                            <td>99%</td>
                            <td>Medium</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
