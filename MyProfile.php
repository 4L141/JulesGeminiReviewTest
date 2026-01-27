<?php
include "load_header.php";
?>

<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h3>Categories</h3>
            <a href="MyProfile.php" class="sidebar-btn">Profile Info</a>
            <a href="Overview.php" class="sidebar-btn">Overview</a>
            <a href="MyProjects.php" class="sidebar-btn">My Projects</a>
            <a href="EnergyCalculator.php" class="sidebar-btn">Calculators</a>
            <a href="Schedule.php" class="sidebar-btn">Schedule</a>
        </aside>

        <section class="main-content">
            <h1>My Profile page</h1>
            <p><strong>Information</strong></p>
            <div class="auth-container profile-form-container">
                <form action="MyProfile.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="User Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'] ?? ''; ?>">
                    </div>
                    <button type="submit" class="auth-btn update-btn">Update Profile</button>
                </form>
            </div>

            <div class="content-block">
                <p><strong>Read only text</strong></p>
                <p>This section contains your account preferences and historical data. You can view your account status and membership level here.</p>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
