<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $request = [
        "Action" => "login",
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ];

    $inputFile  = __DIR__ . '\json\request.json';
    $outputFile = __DIR__ . '\json\response.json';

    file_put_contents($inputFile, json_encode($request, JSON_PRETTY_PRINT));

    $exePath = '..\console_backend\console_backend\bin\Debug\net8.0\console_backend.exe';

    $command = '"' . $exePath . '" ' .
               escapeshellarg($inputFile) . ' ' .
               escapeshellarg($outputFile);

    exec($command);

    if (file_exists($outputFile)) {
        $response = json_decode(file_get_contents($outputFile), true);



        if ($response["Status"] === "success") {
            $_SESSION["logged_in"] = true;
            $_SESSION["role"] = $response["User"]["role"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["id"] = $response["User"]["id"];

            header("Location: Homepage.php");
            exit;
        } else {
            $error = $response["Message"];
        }
    } else {
        $error = "Backend error";
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <form method="post">
        <h1>Login</h1>

        <?php if (isset($error)) echo "<p>$error</p>"; ?>

        <div>
            <label>Email:</label>
            <input type="text" name="email" required>
        </div>

        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>
        <a href="SignUp.php">Sign Up</a>
    </form>
</main>
</body>
</html>
