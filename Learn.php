<?php
include "load_header.php";
?>

<main>
    <section class="hero">
        <h1>Learn About Renewable Energy</h1>
        <p>Educational resources to help you transition to a sustainable future.</p>
    </section>

    <div class="search-bar" style="width: 90vw; margin: 2rem auto;">
        <input type="text" placeholder="Search topics...">
        <button class="auth-btn">Search</button>
    </div>

    <div class="item-grid">
        <div class="item-card">
            <i data-lucide="book"></i>
            <h3>Solar Basics</h3>
            <p>How photovoltaic cells work.</p>
            <a href="#" class="auth-btn" style="display: inline-block; width: auto;">Read More</a>
        </div>
        <div class="item-card">
            <i data-lucide="zap"></i>
            <h3>Energy Efficiency</h3>
            <p>Tips for reducing your home energy usage.</p>
            <a href="#" class="auth-btn" style="display: inline-block; width: auto;">Read More</a>
        </div>
        <div class="item-card">
            <i data-lucide="leaf"></i>
            <h3>Carbon Footprint</h3>
            <p>Understanding your environmental impact.</p>
            <a href="#" class="auth-btn" style="display: inline-block; width: auto;">Read More</a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
