<?php
include "load_header.php";
?>
<main>
    <h1>Overview</h1>
    <p>View the overview of your projects.</p>
    <form action="overview.php" method="post">
        <label for="project">Project:</label>
        <input type="text" name="project" id="project">
        <button type="submit">Search</button>
    </form>
</main>
<?php include 'footer.php'; ?>