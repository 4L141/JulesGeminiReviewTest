<?php
include 'backend_call.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        empty($_POST["first_name"]) ||
        empty($_POST["last_name"]) ||
        empty($_POST["username"]) ||
        empty($_POST["email"]) ||
        empty($_POST["phone"]) ||
        empty($_POST["password"]) ||
        empty($_POST["password2"])
    ) {
        $error = "All fields are required";
    } elseif ($_POST["password"] !== $_POST["password2"]) {
        $error = "Passwords do not match";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email";
    } elseif (!isset($_POST["agree"])) {
        $error = "You must agree to the terms";
    } else {
        $response = callBackend([
            "Action" => "signup",
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "username" => $_POST["username"],
            "email" => $_POST["email"],
            "phone" => $_POST["phone"],
            "password" => $_POST["password"]
        ]);

        if ($response && $response["Status"] === "success") {
            header("Location: LogIn.php?signup=success");
            exit;
        } else {
            $error = $response["Message"] ?? "No response from backend";
        }
    }
}

include "header_guest.php";
?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h1>Sign Up</h1>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form action="SignUp.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last name:</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required minlength="4">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required minlength="8">
            </div>

            <div class="form-group">
                <label for="password2">Confirm Password:</label>
                <input type="password" name="password2" id="password2" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="agree" value="yes" required> I agree with the
                    <a href="#">terms of service</a>
                </label>
            </div>

            <button type="submit" class="auth-btn">Sign Up</button>

            <div class="auth-footer">
                <p>Already have an account? <a href="LogIn.php">Login</a></p>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
