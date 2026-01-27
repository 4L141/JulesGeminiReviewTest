<?php
session_start();
include 'backend_call.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $response = callBackend([
        "Action" => "login",
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);

    if ($response && $response["Status"] === "success") {
        $_SESSION["logged_in"] = true;
        $_SESSION["role"] = $response["User"]["role"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["id"] = $response["User"]["id"];

        header("Location: Homepage.php");
        exit;
    } else {
        $error = $response["Message"] ?? "Backend error";
    }
}

include "header_guest.php";
?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>

            <div class="auth-footer">
                <p>Don't have an account? <a href="SignUp.php">Sign Up</a></p>
                <p><a href="ForgotPassword.php">Forgot Password?</a></p>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
