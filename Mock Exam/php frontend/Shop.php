<?php
include "load_header.php";
?>
<main>
    <h1>Shop</h1>
    <p>Shop for the latest in technology.</p>
    <form action="shop.php" method="post">
        <label for="product">Product:</label>
        <input type="text" name="product" id="product">
        <button type="submit">Search</button>
    </form>
</main>
<?php include 'footer.php'; ?>