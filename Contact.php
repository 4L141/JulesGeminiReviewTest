<?php
include "load_header.php";
?>

<main>
    <section class="info-section">
        <h1>Contact Us</h1>

        <div class="dashboard-layout contact-layout">
            <div class="content-block contact-info">
                <h3>Get in Touch</h3>
                <p>Have questions about solar installation or EV charging? Our team is here to help.</p>
                <p><strong>Email:</strong> support@rolsa.tech</p>
                <p><strong>Phone:</strong> +44 123 456 7890</p>
            </div>

            <div class="auth-container contact-form-container">
                <form action="Contact.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" rows="5"></textarea>
                    </div>
                    <button type="submit" class="auth-btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
