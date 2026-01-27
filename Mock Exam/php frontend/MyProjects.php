<?php
include "load_header.php";
?>
<main>
    <h1>My Projects</h1>
    <p>View your projects.</p>
    <form action="my_projects.php" method="post">
        <label for="project">Project:</label>
        <input type="text" name="project" id="project">
        <button type="submit">Search</button>
    </form>
</main>
<?php include 'footer.php'; ?>