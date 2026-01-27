<?php
include "load_header.php";
?>
<main>
    <h1>Contact Us</h1>
    <p>Contact us for any questions or concerns.</p>
    <form action="contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="message">Message:</label>
        <textarea name="message" id="message"></textarea>
</main>
<?php include 'footer.php'; ?>