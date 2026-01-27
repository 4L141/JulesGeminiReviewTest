<?php
include "load_header.php";
?>

<main>
    <section class="hero">
        <h1>Our Green Tech Shop</h1>
        <p>Explore our wide range of solar panels, EV chargers, and smart home energy solutions.</p>
    </section>

    <div class="search-bar" style="width: 90vw; margin: 2rem auto;">
        <input type="text" placeholder="Search products...">
        <button class="auth-btn">Search</button>
    </div>

    <div class="item-grid">
        <div class="item-card">
            <i data-lucide="sun"></i>
            <h3>Solar Panel X1</h3>
            <p>High efficiency monocrystalline panel.</p>
            <button class="auth-btn" style="width: auto;">Add to Cart</button>
        </div>
        <div class="item-card">
            <i data-lucide="battery-charging"></i>
            <h3>EV Charger Pro</h3>
            <p>Fast charging for all electric vehicles.</p>
            <button class="auth-btn" style="width: auto;">Add to Cart</button>
        </div>
        <div class="item-card">
            <i data-lucide="cpu"></i>
            <h3>Smart Hub</h3>
            <p>Integrated energy management system.</p>
            <button class="auth-btn" style="width: auto;">Add to Cart</button>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
