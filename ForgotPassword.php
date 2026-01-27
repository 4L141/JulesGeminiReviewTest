<?php
include "header_guest.php";
?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h1>Forgot Password</h1>
        <form action="ForgotPassword.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <button type="submit" class="auth-btn">Reset Password</button>
            <div class="auth-footer">
                <p>Remembered your password? <a href="LogIn.php">Login</a></p>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
