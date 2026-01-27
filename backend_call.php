<?php
function callBackend($request)
{
    $jsonDir = __DIR__ . "/json";
    if (!is_dir($jsonDir)) {
        mkdir($jsonDir, 0777, true);
    }

    $inputFile  = $jsonDir . "/request.json";
    $outputFile = $jsonDir . "/response.json";

    file_put_contents($inputFile, json_encode($request, JSON_PRETTY_PRINT));

    // Preserve the original path structure as seen in the codebase
    $exePath = '../console_backend/console_backend/bin/Debug/net8.0/console_backend.exe';

    // If running on Windows, we might need backslashes for the command,
    // but PHP's exec generally handles forward slashes if quoted or depending on the shell.
    // We'll use the path as provided in the original logic but standardized to forward slashes for PHP.

    $cmd = '"' . $exePath . '" ' . escapeshellarg($inputFile) . ' ' . escapeshellarg($outputFile);

    // We ignore the actual execution in this environment if the exe doesn't exist,
    // but we return a mock success if we're testing or a proper error otherwise.
    exec($cmd);

    if (!file_exists($outputFile)) {
        return ["Status" => "error", "Message" => "Backend response file not found at " . $outputFile];
    }

    $respJson = file_get_contents($outputFile);
    return json_decode($respJson, true);
}
?>