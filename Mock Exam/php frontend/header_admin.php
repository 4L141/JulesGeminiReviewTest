<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css?v=2">
</head>
<body>
<header>
    <nav class="navbar">
    <div class="logo"><a href="Homepage.php">Rolsa Technologies</a></div>
    <ul>
        <li><a href="Shop.php">Shop</a></li>
        <li><a href="Learn.php">Learn</a></li>
        <li><a href="About.php">About</a></li>
        <li><a href="Contact.php">Contact</a></li>
        <li><a href="Schedule.php">Schedule Appointment</a></li>
    </ul>
    <div class="dropdown" style="margin-left:auto;">
        <button onclick="myFunction()" class="dropbtn">Profile</button>
        <div id="myDropdown" class="dropdown-content">
            <a href="MyProfile.php">My Profile</a>
            <a href="Overview.php">Overview</a>
            <a href="MyProjects.php">My Projects</a>
            <a href="Admin.php">Manage Boookings</a>
            <a href="#">Calculators ></a>
            <a href="index.php">Logout</a>
        </div>
    </div>

    </nav>
</header>
<script src="scripts/dropdown.js"></script>
</body>
</html>