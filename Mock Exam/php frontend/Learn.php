<?php
include "load_header.php";
?>
<main>
    <h1>Learn</h1>
    <p>Learn about the latest in technology.</p>
    <form action="learn.php" method="post">
        <label for="topic">Topic:</label>
        <input type="text" name="topic" id="topic">
        <button type="submit">Search</button>
    </form>
</main>
<?php include 'footer.php'; ?>