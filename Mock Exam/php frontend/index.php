<?php
session_start();

session_unset();    // remove all session variables
session_destroy();  // destroy the session

header("Location: Homepage.php");
exit;

include 'header_guest.php';
?>

<main>
    <h1>Welcome to Rolsa Technologies</h1>
</main>
<?php include 'footer.php'; ?>