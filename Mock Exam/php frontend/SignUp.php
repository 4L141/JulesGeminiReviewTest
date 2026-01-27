<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SignUp</title>
</head>
<body>
<main>
    <form action="SignUp.php" method="post">
        <h1>Sign Up</h1>

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>

        <div>
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>

        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required minlength="4">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required minlength="8">
        </div>

        <div>
            <label for="password2">Password Again:</label>
            <input type="password" name="password2" id="password2" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="agree" value="yes" required> I agree with the
                <a href="#">term of services</a>
            </label>
        </div>

        <button type="submit">SignUp</button>
    </form>
</main>
</body>
</html>

<?php

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
        die("All fields are required");
    }

    if ($_POST["password"] !== $_POST["password2"]) {
        die("Passwords do not match");
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email");
    }

    if (!isset($_POST["agree"])) {
        die("You must agree to the terms");
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $request = [
        "Action" => "signup",
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "password" => $_POST["password"]
    ];



    $exePath = $exePath = '..\console_backend\console_backend\bin\Debug\net8.0\console_backend.exe';

    $inputFile = __DIR__ . '\json\request.json';
    $outputFile = __DIR__ . '\json\response.json';

    file_put_contents($inputFile, json_encode($request, JSON_PRETTY_PRINT));

    $command = '"' . $exePath . '" ' .
    escapeshellarg($inputFile) . ' ' .
    escapeshellarg($outputFile);

    exec($command);

    if (file_exists($outputFile)) {
        $response = json_decode(file_get_contents($outputFile), true);
        print_r($response);
    } else {
        echo "No response from backend";
    }
}
