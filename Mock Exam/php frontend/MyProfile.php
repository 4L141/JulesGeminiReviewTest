<?php
include "load_header.php";
?>
<main>
    <h1>My Profile</h1>
    <p>View your profile information.</p>
    <form action="my_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </form>
</main>
<?php include 'footer.php'; ?>